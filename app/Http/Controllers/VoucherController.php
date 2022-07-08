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
        // $this->HttpRequest = new HttpRequest;
	}

    public function listVoucher(Request $request)
    {
        
        $getPost = $request->post();
        $isLogin = session()->get('set_userdata');
        
        if($isLogin['level'] == 'SIGNER'){
            $defaultsts = 'CHECKED';
        }else{
            $defaultsts = 'CREATED';
        }

        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 8;
        $sts_approv = $request->post('stsApproved') ? $request->post('stsApproved') : $defaultsts;
        $key  = $request->post('keyword') ? $request->post('keyword') : "";


        $sts_approval = array();
        if($isLogin['level'] == "MAKER"){
            $sts_approval['CREATED'] = "CREATED";
            $sts_approval['CHECKED'] = "CHECKED";
        }

        if($isLogin['level'] == "CHECKER"){
            $sts_approval['CREATED'] = "REQUEST";
            $sts_approval['CHECKED'] = "CHECKED";
        }

        if($isLogin['level'] == "SIGNER"){
            $sts_approval['CHECKED'] = "REQUEST";
        }
        
        if($isLogin['level'] == "SUPERADMIN"){
            $sts_approval['CREATED'] = "CREATED";
            $sts_approval['CHECKED'] = "CHECKED";
        }

        $sts_approval['APPROVED'] = "APPROVED";
        $sts_approval['REJECTED'] = "REJECTED";
        
        $list_voucher = $this->HttpRequest("GET","/vouchers?page=".$page."&take=".$take."&status=".$sts_approv."&keyword=".$key,null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1", null)->json();
        $list_deposit = $this->HttpRequest("GET","/deposit-account?page=1",null)->json();

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
                Session::flash('success','Create voucher success');
            }else{
                Session::flash('failed','Create voucher failed');
            }

            return Redirect::to('/list-voucher');
        }
        return view('app.voucher.index', $data);
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
            'list_channel'  => $this->optChannel()['data'],
            'list_feature'  => $this->optFeature()['data'],
            'list_deposit'  => $this->optDeposit(),
            'sess_user'    => session()->get('set_userdata'),
        ];
  
        return view('app.voucher.view')->with($data);
    }

    public function UpdateVoucher(Request $request){
        $id = $request->get("id");
        $getPost = $request->post();
        $param = [
            'type'  => $getPost['typeEdit'],
            'limit' => (int) $getPost['limitEdit'],
            'dueDate'=> $getPost['duedateEdit'],
            'minTransaction'    => (int) $getPost['mintransactionEdit'],
            'percent'       => (int) $getPost['percentEdit'],
            'maxPotency'    => (int) $getPost['maxpotencyEdit'],
            'maxRedeem'     => (int) $getPost['maxredeemEdit'],
            'maxDayRedeem'  => (int) $getPost['maxredeemperdayEdit'],
            'description'   => $getPost['descriptionEdit'],
            'featuremain'   => $getPost['mainFeatureEdit'],
            'featuresub'    => isset($getPost['idsubFeatureoption']) ? $getPost['idsubFeatureoption'] : "",
            'channel'       => $getPost['channelEdit'],
            'depositaccount'=> $getPost['depositAccountEdit'],
            'signer'        => $getPost['signerpnEdit'],
            'checker'       => $getPost['checkerpnEdit'],
        ];


        $edit_url = $this->HttpRequest("PUT","/vouchers/$id", $param);

        if(!empty($edit_url)){
            Session::flash('success','Action Success');
        }else{
            Session::flash('failed','Action Failed');
        }

        return Redirect::to('/view-voucher?id='.$id);
    }

    public function ApproveVoucher(Request $request){
        $getPost = $request->post();

        $param = [
            'msg'    => $getPost['msg'],
        ];

        $data = $this->HttpRequest("PUT","/vouchers/".$getPost['idapprove']."/approve", $param);

        if(!empty($data)){
            Session::flash('success','Action Success');
        }else{
            Session::flash('failed','Action Failed');
        }

        return Redirect::to('/view-voucher?id='.$getPost['idapprove']);
    }

    
    public function RejectVoucher(Request $request){
        $getPost = $request->post();

        $param = [
            'msg'    => $getPost['msg'],
        ];

        $data = $this->HttpRequest("PUT","/vouchers/".$getPost['idreject']."/reject", $param);

        if(!empty($data)){
            Session::flash('success','Action Success');
        }else{
            Session::flash('failed','Action Failed');
        }

        return Redirect::to('/view-voucher?id='.$getPost['idreject']);
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

    public function activeInactive(Request $request)
    {
        $id = $request->get('id');

        $update_activeinactive = $this->HttpRequest("PUT","/vouchers/$id/activeChange", null)->json();

        if(!empty($update_activeinactive)){
            Session::flash('success','Voucher activation changed');
        }else{
            Session::flash('failed', $update_activeinactive['msg']);
        }

        return $update_activeinactive;
    }
}
