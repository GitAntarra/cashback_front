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
        $take = $request->get('take') ? $request->get('take') : 6;

        $getPost = $request->post();
        $list_voucher = $this->HttpRequest("GET","/vouchers/show?page=".$page."&limit".$take,null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1", null)->json();


        $data = [
            'msg'   => '',
            'list_voucher' => $list_voucher,
            'list_channel' => $list_channel['data'],
            'list_feature' => $list_feature['data'],
            'meta'         => (object) $list_voucher['meta'],
            'page'         => $page,
            'take'         => $take,
        ];
        
        if(isset($getPost['vouchercode'])){
            $minTrans = preg_replace("/[^0-9]/", "", $getPost['mintransaction']);
            $maxPotency = preg_replace("/[^0-9]/", "", $getPost['maxpotency']);
            $param = [
                'code'  => $getPost['vouchercode'],
                'type'  => $getPost['type'],
                'limit' => (int) $getPost['limit'],
                'dueDate'   => "2022-04-08 12:57:18",
                'minTransaction'    => (int) $minTrans,
                'maxPotency'        => (int) $maxPotency,
                'percent'   => (int) $getPost['percent'],
                'maxRedeem' => (int) $getPost['maxredeem']
            ];
            $url_addVoucher = $this->HttpRequest->service("POST","/vouchers", $param);
            if(empty($url_addVoucher)){
                Session::flash('success','action success');
                return Redirect::to('/list-voucher');
            }else{
                Session::flash('failed','action failed');
                return Redirect::to('/list-voucher');
            }
        }
        return view('voucher.voucher-list')->with($data);
    }

    public function viewVoucher(Request $request)
    {
        
        return view('voucher.voucher-view');
    }

    public function editVoucher(Request $request)
    {

    }

    public function deleteVoucher(Request $request)
    {

    }
}
