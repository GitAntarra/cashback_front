<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;
	}

    public function listVoucher(Request $request)
    {
        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 8;
        $sts_approv = $request->post('stsApproved') ? $request->post('stsApproved') : "CREATED";
        $key  = $request->post('keyword') ? $request->post('keyword') : "";

        $getPost = $request->post();
        $list_voucher = $this->HttpRequest("GET","/vouchers?page=".$page."&take=".$take."&status=".$sts_approv."&keyword=".$key,null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1", null)->json();
        $list_deposit = $this->HttpRequest("GET","/deposit-account?page=1",null)->json();

        $sts_approval = [
            "ALL"       => "ALL",
            "CREATED"   => "CREATED",
            "CHECKED"   => "CHECKED",
            "APPROVED"  => "APPROVED"
        ];

        $data = [
            'msg'   => '',
            'keys'   => $key,
            'sts_aprv'     => $sts_approv,
            'list_voucher' => $list_voucher,
            'list_channel' => $list_channel['data'],
            'list_feature' => $list_feature['data'],
            'list_deposit' => $list_deposit['data'],
            'meta'         => (object) $list_voucher['meta'],
            'sts_approved' => $sts_approval,
            'page'         => $page,
            'take'         => $take,
            'prevPage'     => (int) $page -1,
            'nextPage'     => (int) $page +1
        ];
        
        if(isset($getPost['createVoucher'])){
            $minTrans = preg_replace("/[^0-9]/", "", $getPost['mintransaction']);
            $maxPotency = preg_replace("/[^0-9]/", "", $getPost['maxpotency']);
            $ndate =  date("Y-m-d H:i:s", strtotime($getPost['duedate']));

            $param = [
                'code'  => $getPost['vouchercode'],
                'type'  => $getPost['type'],
                'limit' => (int) $getPost['limit'],
                'dueDate'   => $ndate,
                'minTransaction'    => (int) $minTrans,
                'maxPotency'        => (int) $maxPotency,
                'percent'   => (int) $getPost['percent'],
                'maxRedeem' => (int) $getPost['maxredeem'],
                'maxredeemperday' => (int) $getPost['maxredeemperday'],
                'channel'   => $getPost['channel'],
                'featuremain'   => (string) $getPost['idmainFeature'],
                'featuresub'    => $getPost['idsubFeatureoption'] ? $getPost['idsubFeatureoption'] : "",
                'depositaccount'=> $getPost['depositAccount'],
            ];

            $url_addVoucher = (object) $this->HttpRequest("POST","/vouchers", $param);

            if(!empty($url_addVoucher)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }

            return Redirect::to('/list-voucher');
        }
        return view('app.voucher.voucher-list')->with($data);
    }

    public function viewVoucher(Request $request)
    {
        $id = $request->get("id");
        $postParam = $request->post();

        $data_voucher = $this->HttpRequest("GET","/vouchers/".$id, null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1&take=50", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1&take=50", null)->json();
        $list_deposit = $this->HttpRequest("GET","/deposit-account/list",null)->json();
       

        $data = [
            'data'  => $data_voucher,
            'list_channel'  => $list_channel['data'],
            'list_feature'  => $list_feature['data'],
            'list_deposit'  => $list_deposit,
        ];



        if(isset($postParam['editVoucher'])){
            $param = [
                'type'  => $postParam['typeEdit'],
                'limit' => (int) $postParam['limitEdit'],
                'dueDate'=> $postParam['duedateEdit'],
                'minTransaction'    => (int) $postParam['mintransactionEdit'],
                'percent'       => (int) $postParam['percentEdit'],
                'maxPotency'    => (int) $postParam['maxpotencyEdit'],
                'maxRedeem'     => (int) $postParam['maxredeemEdit'],
                'maxDayRedeem'  => (int) $postParam['maxredeemperdayEdit'],
                'description'   => $postParam['descriptionEdit'],
                'featuremain'   => $postParam['mainFeatureEdit'],
                'featuresub'    => $postParam['idsubFeatureoption'],
                'channel'       => $postParam['channelEdit'],
                'depositaccount'=> $postParam['depositAccountEdit'],
            ];

            $edit_url = $this->HttpRequest("PUT","/vouchers/".$id, $param);

            if(!empty($edit_url)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }

            return Redirect::to('/view-voucher?id='.$id);
        }

        return view('app.voucher.voucher-view')->with($data);
    }

    public function getVoucherbyId(Request $request)
    {
        $id = $request->get('id');

        $data_voucher = $this->HttpRequest("GET","/vouchers/".$id, null)->json();

        return $data_voucher;
    }

    public function deleteVoucher(Request $request)
    {

    }
}
