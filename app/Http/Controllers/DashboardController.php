<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Session;

class DashboardController extends Controller
{
    //ecommerce
    public function dashboard(Request $request){
        // $menuData['menu'] =json_decode(json_encode(Session::get('menu')),false);
        // $object = (object) $menuData;
        //   echo "<pre>";
        //   print_r(Session::get('set_userdata'));
        //   die;

        return view('home.index');
    }
    // analystic
    // public function dashboardAnalytics(){
    //     return view('pages.dashboard-analytics');
    // }
}
