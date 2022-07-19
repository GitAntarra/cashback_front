<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Client\RequestException;
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

        
        if(isset($postParam['addDeposit'])){
            $param = [
                'account_number'    => $postParam['accountNumber'],
                'remark'            => $postParam['remark']
            ];

            try {
                $add_url = $this->HttpRequest("POST", "/deposit-account/", $param)->json();
                if(!empty($add_url)){
                    Session::flash('success','Add deposit account success');
                }else{
                    Session::flash('error','Deposit account alreadey exist');
                }
            } catch (\Throwable $th) {
                Session::flash('error','Add deposit account failed');
                return Redirect::to('/deposit-account');
            }
            
                // return $add_url->status();
            // if(!empty($add_url)){
            //     Session::flash('success','action success');
            // }else{
            //     Session::flash('failed','action failed');
            // }
    
            // return Redirect::to('/deposit-account');
        }
        
        $depositAccount = $this->HttpRequest("GET","/deposit-account?page=".$page."&take=".$take."&keyword=".$keyword,null);

        $data = [
            'data_deposit'  => $depositAccount['data'] ? $depositAccount['data'] : '',
            'meta'          => $depositAccount['meta'] ? (object) $depositAccount['meta'] : '',
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

        if(!empty($edit)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }

        return $edit;
    }
}