<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class PembukuanController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;  
    }

    public function listPembukuan(Request $request){
        $postParam = $request->post();

        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 5;
        $status = $request->post('statusRedeem') ? $request->post('statusRedeem') : "SUCCESS";

        $data_pembukuan = $this->HttpRequest("GET","/redeemers?page=".$page."&take=".$take."&bookstatus=".$status, null)->json();

        if(isset($postParam['retryPembukuan'])){
            $param = [
                'transaction_id'    => $postParam['idTransactionRetry'],
                'code'              => $postParam['codeRetry'],
                'remarks'           => $postParam['remarkRetry'],
            ];

            $retry_url = $this->HttpRequest("POST","/schedulers/retryfund", $param);

            if(!empty($retry_url)){
                Session::flash('success',$retry_url['message']);
            }else{
                Session::flash('failed','action failed');
            }
            return Redirect::to('/list-pembukuan');

        }

        if(isset($postParam['donePembukuan'])){

            $param = [
                'transaction_id'    => $postParam['idTransactionDone'],
                'code'              => $postParam['codeDone'],
            ];

            $retry_url = $this->HttpRequest("POST","/schedulers/donefund", $param);

            if(!empty($retry_url)){
                Session::flash('success',$retry_url['message']);
            }else{
                Session::flash('failed','action failed');
            }
            return Redirect::to('/list-pembukuan');

        }

        

        $data = [
            'pembukuan'     => $data_pembukuan['data'],
            'meta'          => (object) $data_pembukuan['meta'],
            'nextPage'      => $page + 1,
            'prevPage'      => $page - 1,
            'status'        => $status
        ];


        return view('app.pembukuan.list-pembukuan')->with($data);
    }
}
