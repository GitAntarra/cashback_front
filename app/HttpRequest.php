<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Redirect;

use Illuminate\Database\Eloquent\Model;
use Session;

class HttpRequest extends Model
{
    public function service($method, $endpoint, $param = [])
    {
      // print_r($param['pernr']);die;
      $api_url = env("API_URL").$endpoint;
      $token = Session::get("accessToken");
      $response = Http::withToken($token);

      // echo $method;

      if($method == "GET"){
        $response = $response->get($api_url);
      }else if($method == "POST"){
        $response = $response->post($api_url,$param);
      }
      $res = json_decode($response, true);
      return $res;die;

      if($response->successful()){
        return $res;
      }
      else{
          if($response->status() == '401'){
            return Redirect::to('/logout');
          }
          return "error";
      }
    }

    // public function login(Request $response){
    //     $response = (object) Http::withHeaders([
    //         'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
    //       ])->post('http://172.18.135.224:3004/auth/signin', $req_param);
    // }
}
