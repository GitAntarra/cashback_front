<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
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

    public function HttpRequest($method, $endpoint, $bodyRequest = ""){

            $api_url = env("API_URL").$endpoint;
            $token = Session::get("accessToken");
            $response = Http::acceptJson()->timeout(10)->retry(3, 5000)->withToken($token);

            if($method == "GET"){
                $response = $response->get($api_url)->throw();
            }else if($method == "POST"){
                $response = $response->post($api_url, $bodyRequest)->throw();
            }else if($method == "DELETE"){
                $response = $response->delete($api_url)->throw();
            }else if($method == "PUT"){
                $response = $response->put($api_url, $bodyRequest)->throw();
            }

            if($response->status() == 401){
                abort(401);
            }elseif($response->status() == 502){
                return redirect('/auth-login');
            }elseif($response->status() == 404){
                return "123";
                abort(404, $response['message'] ? implode($response['message']) : 'Not Found');
            }elseif($response->status() == 400){
                abort(333, $response['message'] ? implode($response['message']) : 'unknowerror');
                print_r($response['message'][0]); die;    
            }elseif($response->status() == 403){
                abort(333, $response['message'] ? $response['message'] : 'unknowerror');
            }elseif($response->failed()){
                abort(333, 'error');
            }else{
                return $response;
            }
    }

    public function optChannel(){
        return $this->HttpRequest("GET","/channel?page=1&take=50", null)->json();
    }

    public function optFeature(){
        return $this->HttpRequest("GET", "/feature?page=1&take=50", null)->json();
    }

    public function optDeposit(){
        return $this->HttpRequest("GET","/deposit-account/list",null)->json();
    }

    public function Downloadfile($method, $endpoint, $bodyRequest = ""){
        // $tempName = tempnam(sys_get_temp_dir(), 'response').'.pdf';
        $api_url = env("API_URL").$endpoint;
        $token = Session::get("accessToken");
        $response = Http::withHeaders(['Content-Type' => 'text/xlsx'])->withToken($token);

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
        }elseif($response->status() == 502){
            return Redirect::to('/auth-login');
        }elseif($response->status() == 404){
            abort(404);
        }elseif($response->status() == 400){
            abort(333, 'validations');
        }elseif($response->status() == 403){
            abort(333, $response['message'] ? $response['message'] : 'unknowerror');
        }elseif($response->failed()){
            abort(333, 'error');
        }else{
            return $response;
        }
    }
}
