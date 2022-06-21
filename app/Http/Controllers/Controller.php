<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Session;
use Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function UserLogin(){
        $data = Session::get("set_userdata");;

        return $data;
    }

    public function HttpRequest($method = "get", $endpoint, $bodyRequest = ""){
        $api_url = env("API_URL").$endpoint;
        $token = Session::get("accessToken");
        $response = Http::acceptJson()->withToken($token);

        if($method == "GET"){
            $response = $response->get($api_url);
        }else if($method == "POST"){
            $response = $response->post($api_url, $bodyRequest);
        }else if($method == "DELETE"){
            $response = $response->delete($api_url);
        }else if($method == "PUT"){
            $response = $response->put($api_url, $bodyRequest);
        }

        if($response->status() == 401){
            abort(401);
        }elseif($response->status() == 404){
            abort(404);
        }elseif($response->failed()){
            abort(333, 'error');
        }else{
            return $response;
        }
    }
}
