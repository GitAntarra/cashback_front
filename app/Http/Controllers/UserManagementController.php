<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequest;
use Session;

class UserManagementController extends Controller
{
    public function __construct()
    {
        // $this->helper = new helper;
    }
  public function list(){
    //   echo grade('test');
      
      $res = ApiRequest("GET", "/users/shows", null);

    //   if(($res['data'])){
        print_r($res['data']);
          print_r($res['meta']);
          print_r($res['links']);
    //   }
    //   return $res;
  }
}
