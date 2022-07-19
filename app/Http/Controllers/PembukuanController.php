<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Redirect;
use Illuminate\Support\Facades\Storage;

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
        $keyword = $request->post('keyword') ? $request->post('keyword') : "";
        $channel = $request->post('channelopt') ? $request->post('channelopt') : "";
        $debit_account = $request->post('debit_account') ? $request->post('debit_account') : "";
        
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
                Session::flash('failed','Action Failed');
            }
        }

        if(isset($postParam['downloadexcel'])){
            $url_download = $this->Downloadfile("GET","/bookkeeping?page=$page&take=$take&status=$status&keyword=$keyword&debit_account=$debit_account", null)->json();

            $test[] = array(); 
            $data = ($url_download['data']) ? (array) $url_download['data'] : (array) $test;
            
            $filename = "Pembukuan-".date("Y-m-d").".csv";

            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);
            // header("Content-Transfer-Encoding: UTF-8");

            $f = fopen('php://output', 'a');
            fputcsv($f, array_keys($data[0]));

            foreach ($data as $row) 
            {
                fputcsv($f, $row);
            }
            fclose($f);
            die;
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
                Session::flash('failed','Action Failed');
            }
        }

        $data_pembukuan = $this->HttpRequest("GET","/bookkeeping?page=".$page."&take=".$take."&status=".$status."&keyword=".$keyword."&channel=".$channel."&debit_account=".$debit_account, null)->json();


        $data = [
            'pembukuan'     => $data_pembukuan['data'],
            'meta'          => (object) $data_pembukuan['meta'],
            'nextPage'      => $page + 1,
            'prevPage'      => $page - 1,
            'status'        => $status,
            'keyword'       => $keyword,
            'debit_account' => $debit_account,
            'channel'       => $channel,

        ];


        return view('app.pembukuan.list-pembukuan')->with($data);
    }

    public function donePembukuan(Request $request){
        $postParam = $request->post();

        $param = [
            'transaction_id'    => $postParam['idTransactionDone'],
            'code'              => $postParam['codeDone'],
        ];

        $done_url = $this->HttpRequest("POST","/schedulers/donefund", $param);

        if(!empty($done_url)){
            Session::flash('success',$retry_url['message']);
        }else{
            Session::flash('failed','Action Failed');
        }

        return $done_url;
    }

    public function retryPembukuan(Request $request){
        $param = [
            'transaction_id'    => $postParam['idTransactionRetry'],
            'code'              => $postParam['codeRetry'],
            'remarks'           => $postParam['remarkRetry'],
        ];

        $retry_url = $this->HttpRequest("POST","/schedulers/retryfund", $param);

        if(!empty($retry_url)){
            Session::flash('success',$retry_url['message']);
        }else{
            Session::flash('failed','Action Failed');
        }

        return $retry_url;
    }

    public function getChannelopt(Request $request){
        $channel = $request->get('channelopt');

        $list_channel = $this->HttpRequest("GET","/channel?page=1&take=5&keyword=".$channel, null)->json();
        $i=0;
        foreach($list_channel['data'] as $row){
            $data[$i++] = [
                'id'    => $row['channel_id'],
                'text'  => $row['channel_id']
            ];
        }

        return $data;
    }

    public function getDepositAccount(Request $request)
    {
        $keyword = $request->get('keyword');

        $deposit_acount =  $this->HttpRequest("GET","/deposit-account/list?keyword=".$keyword,null)->json();

        $i=0;
        foreach($deposit_acount as $row){
            $data[$i++] = [
                'id'    => $row['account_number'],
                'text'  => $row['account_number']." - ". $row['short_name']
            ];
        }

        return $data;
    }

    public function testdownload(){
        $url_download = $this->Downloadfile("GET","/bookkeeping?page=1&take=5&status=SUCCESS&keyword=&debit_account=", null)->json();

            $data = (array) $url_download['data'];
            $filename = "Pembukuan-".date("Y-m-d").".csv";

            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);
            // header("Content-Transfer-Encoding: UTF-8");

            $f = fopen('php://output', 'a');
            fputcsv($f, array_keys($data[0]));

            foreach ($data as $row) 
            {
                fputcsv($f, $row);
            }
            fclose($f);
            die;
    }
}
