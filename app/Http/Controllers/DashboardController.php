<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Session;

class DashboardController extends Controller
{
    //ecommerce
    public function dashboard(Request $request){
        // print_r(Session::get('isLogin'));
        
        // die;
        // $value = $request->session()->get('userMenu');
        
        //     // echo "<pre>";
        //     // $data = Session::get('isLogin');
        //     print_r($value);
        //     die;
            // $menu = $data['menu'];
            // $json_menu = json_encode($data['menu']);
            // var_dump($menu[0]['menus']);
            // $menus = $menu[0]['menus'];
            // foreach($menus as $row){
            //     echo $row['title'];
            // }
        return view('pages.dashboard-ecommerce');
    }
    // analystic
    // public function dashboardAnalytics(){
    //     return view('pages.dashboard-analytics');
    // }
}
