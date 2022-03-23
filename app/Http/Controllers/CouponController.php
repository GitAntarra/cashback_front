<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() {
        $data['pageConfigs'] = ['pageHeader' => true];
        $data['breadcrumbs'] = [
            ["link" => "/", "name" => "Home"],["name" => "Manage Coupon"]
        ];
        return view('app.coupon.index',$data);
    }
}
