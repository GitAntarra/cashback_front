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

        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 5;
        $status = $request->post('statusRedeem') ? $request->post('statusRedeem') : "SUCCESS";

        $data_pembukuan = $this->HttpRequest("GET","/redeemers?page=".$page."&take=".$take."&bookstatus=".$status, null)->json();

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
