<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class DepositAccountController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;
	}

    public function listDepositAccount(Request $request)
    {
        
        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 5;

        $postParam = $request->post();
        
        if(isset($postParam['addDeposit'])){
            $param = [
                'account_number'    => $postParam['accountNumber'],
                'remark'            => $postParam['remark']
            ];

            $add_url = $this->HttpRequest("POST", "/deposit-account/", $param);

            if(!empty($add_url)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/deposit-account');
        }

        $depositAccount = $this->HttpRequest("GET","/deposit-account?page=1",null);

        $data = [
            'data_deposit'  => $depositAccount['data'],
            'meta'          => (object) $depositAccount['meta']
        ];
        return view('app.deposit-account.deposit-account')->with($data);
    }
}
