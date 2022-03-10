<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Session;
use Redirect;

class ApiRequest extends Model
{
    public function api($METHOD = "GET", $ENDPOINT, $BODY = [] ) {
        $token = Session::get('accessToken');
        $URL = env('API_URL').$ENDPOINT;
        $response = Http::withToken('oiasd');
        if($METHOD == "GET"){
            $response = $response->get($URL);
        }

        if($METHOD == "POST"){
            $response = $response->post($URL, $BODY);
        }

        if($METHOD == "PATCH"){
            $response = $response->patch($URL, $BODY);
        }

        if($METHOD == "DELETE"){
            $response = $response->delete($URL, $BODY);
        }

        // return Redirect::to('/auth-login');

        if($response->successful()){
            return $response;
        }else{
            if($response->status() == 401){
                Session::flush();
                return Redirect::to('/auth-login');
                // return $response->status();
            }
        }
    }
}
