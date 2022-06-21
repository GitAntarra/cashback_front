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
        $keyword = $request->post('keyword') ? $request->post('keyword') : '';

        $postParam = $request->post();

        $depositAccount = $this->HttpRequest("GET","/deposit-account?page=".$page."&take=".$take."&keyword=".$keyword,null);
        
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

        $data = [
            'data_deposit'  => $depositAccount['data'],
            'meta'          => (object) $depositAccount['meta'],
            'prevPage'      => (int) $page - 1,
            'nextPage'      => (int) $page + 1,
            'keyword'       => $keyword,
        ];
        return view('app.deposit-account.deposit-account')->with($data);
    }

    public function updateDeposit(Request $request)
    {
        
        $postParam = $request->post();

        $param = [
            'account_number'    => $postParam['accountEdit'],
            'remark'            => $postParam['remarkEdit']
        ];

        $edit = $this->HttpRequest("POST", "/deposit-account/view", $param)->json();

        return $edit;
    }
}
