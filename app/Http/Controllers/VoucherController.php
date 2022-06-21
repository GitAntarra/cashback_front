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
            "APPROVED"  => "APPROVED",
            "REJECTED"  => "REJECTED",
            "UPDATED"   => "UPDATED"
        ];

        $data = [
            'msg'   => '',
            'keys'   => $key,
            'sts_aprv'     => $sts_approv,
            'list_voucher' => $list_voucher['data'],
            'list_channel' => $list_channel['data'],
            'list_feature' => $list_feature['data'],
            'list_deposit' => $list_deposit['data'],
            'meta'         => (object) $list_voucher['meta'],
            'sts_approved' => $sts_approval,
            'page'         => $page,
            'take'         => $take,
            'prevPage'     => (int) $page -1,
            'nextPage'     => (int) $page +1,
            'sess_user'    => session()->get('set_userdata'),
        ];

        
        if(isset($getPost['createVoucher'])){
            $minTrans = preg_replace("/[^0-9]/", "", $getPost['mintransaction']);
            $maxPotency = preg_replace("/[^0-9]/", "", $getPost['maxpotency']);
            $ndate =  date("Y-m-d H:i:s", strtotime($getPost['duedate']));

            $param = [
                'code'          => $getPost['vouchercode'],
                'type'          => $getPost['type'],
                'limit'         => (int) $getPost['limit'],
                'dueDate'       => $ndate,
                'minTransaction'=> (int) $minTrans,
                'maxPotency'    => (int) $maxPotency,
                'percent'       => (int) $getPost['percent'],
                'maxRedeem'     => (int) $getPost['maxredeem'],
                'maxDayRedeem' => (int) $getPost['maxredeemperday'],
                'channel'       => $getPost['channel'],
                'featuremain'   => (string) $getPost['idmainFeature'],
                'featuresub'    => $getPost['idsubFeatureoption'] ? $getPost['idsubFeatureoption'] : "",
                'depositaccount'=> $getPost['depositAccount'],
                'signer'        => $getPost['signerpn'],
                'checker'       => $getPost['checkerpn'],
                'description'   => $getPost['description']
            ];
            $url_addVoucher = (object) $this->HttpRequest("POST","/vouchers", $param);

            if(!empty($url_addVoucher)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }

            return Redirect::to('/list-voucher');
        }
        return view('app.voucher.test', $data);
    }

    public function viewVoucher(Request $request)
    {
        $id = $request->get("id");
        $postParam = $request->post();
        if(isset($postParam['approveVoucher'])){
            $param = [
                'status'    => $postParam['statusVoucher'],
            ];

            $approve_url = $this->HttpRequest("PUT","/vouchers/".$id, $param);

            if(!empty($approve_url)){
                Session::flash('success','Action Success');
            }else{
                Session::flash('failed','Action Failed');
            }

            return Redirect::to('/view-voucher?id='.$id);
        }

        if(isset($postParam['ApproveVoucher']))
        {

            $param = [
                'msg'   => $postParam['remarkApproval']
            ];
            $id = $request->get('id');

            if($postParam['statusVoch'] == 'APPROVED'){
                $status_Voucher = $this->HttpRequest("PUT","/vouchers/$id/approve", $param);
            }else{
                $status_Voucher = $this->HttpRequest("PUT","/vouchers/$id/reject", $param)->json();
            }

            if(!empty($status_Voucher)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','Action Failed');
            }

            return Redirect::to('/view-voucher?id='.$id);
        }

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
                'signer'        => $postParam['signerpnEdit'],
                'checker'       => $postParam['checkerpnEdit'],
            ];

            // echo "<pre>";
            // print_r($param);
            // die;

            $edit_url = $this->HttpRequest("PUT","/vouchers/$id", $param);

            if(!empty($edit_url)){
                Session::flash('success','Action Success');
            }else{
                Session::flash('failed','Action Failed');
            }

            return Redirect::to('/view-voucher?id='.$id);
        }


        $data_voucher = $this->HttpRequest("GET","/vouchers/".$id, null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1&take=50", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1&take=50", null)->json();
        $list_deposit = $this->HttpRequest("GET","/deposit-account/list",null)->json();

        // echo "<pre>";
        // print_r($data_voucher);
        // die;
       

        $data = [
            'data'  => $data_voucher,
            'list_channel'  => $list_channel['data'],
            'list_feature'  => $list_feature['data'],
            'list_deposit'  => $list_deposit,
            'sess_user'    => session()->get('set_userdata'),
        ];

        return view('app.voucher.voucher-view')->with($data);
    }

    public function getVoucherbyId(Request $request)
    {
        $id = $request->get('id');

        $data_voucher = $this->HttpRequest("GET","/vouchers/".$id, null)->json();

        return $data_voucher;
    }

    public function statusVoucher(Request $request)
    {
        $id =  $request->get('idVoucher');
        $param = [
            'msg'    => $request->get('pesanApproval'),
        ];

        if($request->get('statusVoch') == 'APPROVED'){
            $status_Voucher = $this->HttpRequest("PUT","/vouchers/".$id."/approve", $param);
        }else{
            $status_Voucher = $this->HttpRequest("PUT","/vouchers/".$id."/reject", $param);
        }
        

        return $status_Voucher;
    }

    public function getChecker(Request $request)
    {
        $checker = $request->get('search');

        $param = array(
            "key" => $checker,
            "level"=> "CHECKER",
            "uker" => "ALL",
            "status" => "ACTIVED"
        );

        $data_user['result'] = $this->HttpRequest("POST", "/users/find/employee", $param)->json();

        return $data_user;
    }

    public function getSigner(Request $request)
    {
        $signer = $request->get('signerpn');
        
        $param = array(
            "key" => $signer,
            "level"=> "SIGNER",
            "uker" => "ALL",
            "status" => "ACTIVED"
        );

        $data_user['result'] = $this->HttpRequest("POST", "/users/find/employee", $param)->json();
        return $data_user;
    }

    public function activeInactive()
    {
        $id = $request->get('idvoucher');

        $update_activeinactive = $this->HttpRequest("PUT","vouchers/$id/activeChange", null);

        return $update_activeinactive;
    }
}
