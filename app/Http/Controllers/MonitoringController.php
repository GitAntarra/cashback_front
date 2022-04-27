<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class MonitoringController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;  
    }

    public function listMonitoring(Request $request){
        $getpost = $request->post();

        $type = isset($getpost['find']) ? 'find' : 'all';

        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 10;
        $externalid = $type != 'all'  ? $request->post('externalid') : '';
        $date       = $type != 'all' ? $request->post('dateMonit') : now();
        $requestby  = $type != 'all' ? $request->post('requestby') : '';
        $response_code = $type != 'all' ? $request->post('responsecode') : '';

        $dateFormat = date('Y-m-d', strtotime($date));
        // print_r($dateFormat); die();

        $data_monit = $this->HttpRequest("GET","/esb-log?page=".$page."&take=".$take."&externalid=".$externalid."&date=".$dateFormat."&requestby=".$requestby."&responsecode=".$response_code, null)->json();

        $number = ($page * $take) - ($take -1);

        $data = [
            'number'    => (int) $number,
            'datamonit' => $data_monit['data'],
            'meta'      => (object) $data_monit['meta'],
            'page'      => $page, 
            'prevPage'  => (int) $page-1,
            'nextPage'  => (int) $page+1,
            'take'      => $take,
            'externalid'    => $externalid,
            'dates'    => $dateFormat,
            'requestby'     => $requestby,
            'responsecode'  => $response_code,
        ];

        return view('app.monitoring.list-monitoring')->with($data);
    }
}
