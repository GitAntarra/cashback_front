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
        // $user = $request->session()->get('isLogin');
        // echo "<pre>";
        // print_r($user['user']['level']);
        // die;
        $dashboard = $this->HttpRequest("GET","/vouchers/count/dashbord",null)->json();
        

        
        $data = [
            'title'      => "Dashboard",
            'data'       => $dashboard
        ];

        return view('home.index')->with($data);
    }
}
