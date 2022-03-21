<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;
	}

    public function listVoucher(Request $request)
    {
        $getPost = $request->post();
        $list_voucher = $this->HttpRequest->service("GET","/vouchers/show",null);
        // echo "<pre>";
        // print_r($list_voucher);
        $data = [
            'msg'   => '',
            'list_voucher' => $list_voucher,
        ];
        
        if(isset($getPost['vouchercode'])){
            $param = [
                'code'  => $getPost['vouchercode'],
                'type'  => $getPost['type'],
                'limit' => (int) $getPost['limit'],
                'dueDate'   => "2022-04-08 12:57:18",
                'minTransaction'    => (int) $getPost['mintransaction'],
                'maxPotency'        => (int) $getPost['maxpotency'],
                'percent'   => (int) $getPost['percent'],
                'maxRedeem' => (int) $getPost['maxredeem']
            ];
            $url_addVoucher = $this->HttpRequest->service("POST","/vouchers", $param);
            if(empty($url_addVoucher)){
                Session::flash('success','action success');
                return Redirect::to('/list-voucher');
                die;
            }else{
                Session::flash('failed','action failed');
                return Redirect::to('/list-voucher');
                die;
            }
        }
        return view('voucher.voucher-list')->with($data);
    }

    public function editVoucher(Request $request)
    {

    }

    public function deleteVoucher(Request $request)
    {

    }
}
