<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    //

    function index(){
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],["name" => "Table Data Karyawan"]
        ];
        return view('pages.table',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }

    function test(){

        $param = [
            'pernr' => "00263626",
            'password' => "12345"
        ];

        $response = Http::post('http://172.18.135.224:9013/api/v1/auth/login', $param);
        
        // $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        print_r($content);

        // $content = json_decode($response->getBody(), true);
    }
}
