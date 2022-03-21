<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Redirect;

use Illuminate\Database\Eloquent\Model;
use Session;

class HttpRequest extends Model
{

    public function __construct()
    {
      $this->REKAPI       = env("REKAPI");
      $this->BRISTARSURL  = env("BRISTARSURL");
      $this->BRISTARSUSER = env("BRISTARSUSER");
      $this->BRISTARSKEY  = env("BRISTARSKEY");
      $this->BRISTARSFOTO = env("BRISTARSFOTO");
      $this->BRISTARS2ID  = env("BRISTARS2ID");
      $this->BRISTARS2KEY = env("BRISTARS2KEY");
    }

    function authpekerja()
	{
		try{
			$param 		= array(
				'client_id' 	=> $this->BRISTARS2ID,
				'client_secret' => $this->BRISTARS2KEY,
				'scope' 		=> 'public',
				'grant_type' 	=> 'client_credentials'
			);
			$uri 		= "/auth/oauth2/clientCredentials";
			$url 		= $this->BRISTARSURL . $uri;
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_POST, true);

            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query((array)$param));
			$res_curl = curl_exec($curlHandle);
			curl_close($curlHandle);

			$res = json_decode($res_curl, true);

            return $res;
        } catch (Exception $e) {
            return false;
        }
	}

  function get_detail_pekerja($pn)
	{
		$token = $this->authpekerja();

		if(!$token){
			return false;
		}

		try{
			$param 		= array(
				'pernr' 	=> $pn
			);
			$uri 		= "/api/oauth2/pekerja/getDetailPekerja/readable";
			$url 		= $this->BRISTARSURL . $uri;
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_POST, true);
            curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
				"Authorization: Bearer ".$token['access_token'],
			));

      curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query((array)$param));
			$res_curl = curl_exec($curlHandle);
			curl_close($curlHandle);

			$res = json_decode($res_curl, true);

            if (isset($res)) {
				if (isset($res['responseStatus'])) {
					if ($res['responseStatus'] == 'Success') {
						$response = $res['responseData'];
						
						return $response;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
        } catch (Exception $e) {
            return false;
        }
	}

  

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
      }else if ($method == "PATCH"){
        $response = $response->patch($api_url,$param);
      }else if ($method == "DELETE"){
        $response = $response->delete($api_url,$param);
      }
      $res = json_decode($response, true);
      if($response->successful()){
        return $res;
      }
      else{
          if($response->status() == 401){
            Session::flush();
            return Redirect::to('/auth-login');
          }
          echo "<pre>";
          return $response;
      }
    }



    // public function login(Request $response){
    //     $response = (object) Http::withHeaders([
    //         'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
    //       ])->post('http://172.18.135.224:3004/auth/signin', $req_param);
    // }
}
