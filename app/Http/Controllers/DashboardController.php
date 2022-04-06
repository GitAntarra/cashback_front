<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $data_user = $this->HttpRequest("GET", "/users/shows", null)->json();
        $list_voucher = $this->HttpRequest("GET","/vouchers/show",null)->json();
        $list_channel = $this->HttpRequest("GET","/channel?page=1", null)->json();
        $list_feature = $this->HttpRequest("GET", "/feature?page=1", null)->json();
        
        $data = [
            'users'      => (object) $data_user['meta'],
            'vouchers'   => (object) $list_voucher['meta'],
            'channels'   => (object) $list_channel['meta'],
            'features'   => (object) $list_feature['meta']
        ];

        return view('home.index')->with($data);
    }
}
