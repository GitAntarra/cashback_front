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
        $dashboard = $this->HttpRequest("GET","/vouchers/count/dashbord",null)->json();

        // $list_voucher = $this->HttpRequest("GET","/vouchers?page=1&take=10&status=CREATED&keyword=",null)->json();

        $data = [
            'data'       => $dashboard
        ];

        return view('home.index')->with($data);
    }
}
