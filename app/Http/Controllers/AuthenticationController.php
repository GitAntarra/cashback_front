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
    return view('authentication.auth-login',['pageConfigs' => $pageConfigs]);
  }
  //Register page
  public function registerPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('auth.auth-register',['pageConfigs' => $pageConfigs]);
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
        'ip'      => $request->ip(),
        'latitude'=> "tes",
        'longitude'=>"salda"
      ];


        $response = (object) Http::withHeaders([
          'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
        ])->post(env('API_URL').'/auth/signin', $req_param);
      
        


        if(isset($response['accessToken'])){
          Session::put('isLogin', $response);
            Session::put('accessToken', $response['accessToken']);
            Session::put('set_userdata', $response['user']);
            Session::put('userMenu', $response['menu']);
            Session::flash('success','Successful, Welcome '.$response['user']['name']);
            return redirect('/');
        }elseif($response->status() == 502){
            Session::flash('error','502 Bad Gateway');
            return redirect('/auth-login');
        }elseif($response->status() == 401){
            Session::flash('warning','The personal number or password you entered is incorrect');
            return redirect('/auth-login');
        }else{
            Session::flash('warning','Error');
            return redirect('/auth-login');
        }
    }

    public function logout(Request $request){
      $request->session()->flush();
      Session::flash('success','You have logged out, Thank you');
      return redirect('/auth-login');
    }
}
