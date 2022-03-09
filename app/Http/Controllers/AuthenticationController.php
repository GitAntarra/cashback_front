<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\HttpRequest;
use Session;
use Redirect;

class AuthenticationController extends Controller
{
  //Login page
  public function loginPage(){
    
    $value = Session::get('isLogin');
    if($value){
      return redirect::to('/')->withErrors(['msg' => 'The Message']);
    }
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-login',['pageConfigs' => $pageConfigs]);
  }
  //Register page
  public function registerPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-register',['pageConfigs' => $pageConfigs]);
  }
   //forget Password page
   public function forgetPasswordPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-forgot-password',['pageConfigs' => $pageConfigs]);
  }
   //reset Password page
   public function resetPasswordPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-reset-password',['pageConfigs' => $pageConfigs]);
  }
   //auth lock page
   public function authLockPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-lock-screen',['pageConfigs' => $pageConfigs]);
  }

  public function attemplogin(Request $request)
    {

      $req_param = [
        'pernr'   => $request->post('pernr'),
        'password'=> $request->post('password'),
        'ip'      => "102121",
        'latitude'=> "tes",
        'longitude'=>"salda"
      ];


        $response = (object) Http::withHeaders([
          'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
        ])->post('http://172.18.135.224:3004/auth/signin', $req_param);

        
        if(isset($response['accessToken'])){
          Session::put('isLogin', $response);
            Session::put('accessToken', $response['accessToken']);
            Session::put('set_userdata', $response['user']);
            Session::put('menu', $response['menu']);
            return redirect('/');
        }else{
            return redirect('/auth-login');
        }
    }

    public function logout(Request $request){
      $request->session()->flush();
      return redirect('/auth-login');
    }
}
