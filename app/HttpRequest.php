<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HttpRequest extends Model
{
    public function apiWithoutKey($method = "POST", $endpoint, $param = [])
    {
        $client = new Client();
        $url = config('app.urlapi');
        $uri = $url."/".$endpoint;


        $response = $client->request('GET', $uri, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());
        return $responseBody;
    }

    public function apiWithKey($method = "POST", $endpoint, $param = [])
    {
        $client = new Client();
        $url = config('app.urlapi');

        $uri = $url."/".$endpoint;

        $params = [
            //If you have any Params Pass here
        ];

        $headers = [
            'Authorization' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
        ];

        $response = $client->request('GET', $url, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        // $responseBody = json_decode($response->getBody());

        return $response;
    }

    public function login(Request $response){
        $response = (object) Http::withHeaders([
            'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
          ])->post('http://172.18.135.224:3004/auth/signin', $req_param);
    }
}
