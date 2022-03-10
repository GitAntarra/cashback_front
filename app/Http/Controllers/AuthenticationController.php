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
            Session::put('userMenu', $response['menu']);
            return redirect('/');
        }else{
            return redirect('/auth-login');
        }
    }

    // public function attemplogin(Request $request){
    //     $req = [
    //       'pernr'   => $request->post('pernr'),
    //       'password'=> $request->post('password'),
    //       'ip'      => "102121",
    //       'latitude'=> "09238423",
    //       'longitude'=>"324234"
    //     ];
    
    //     $url = env('API_URL')."/auth/signin";
    
    //     $res = Http::post($url, $req);
    
    
    //     if($res->successful()){
    //       Session::put('isLogin', true);
    //       Session::put('accessToken', $res['accessToken']);
    //       Session::put('userData', $res['user']);
    //       Session::put('userMenu', $res['menu']);
    //       return redirect('/');
    //     }else{
    //       return route('auth-login');
    //     }
    //   }

  

  // public function attemploginss(Request $request)
  //   {

  //     $req_param = [
  //       'pernr'   => $request->post('pernr'),
  //       'password'=> $request->post('password'),
  //       'ip'      => "102121",
  //       'latitude'=> "tes",
  //       'longitude'=>"salda"
  //     ];


  //       $response = (object) Http::withHeaders([
  //         'app-owner' => '$(@uRn]*v`g[(^]LC)cR~?_<^YjcG?/X^9FH6Tg(j-SMmw+wd9t+r'
  //       ])->post('http://localhost:3000/api/v1/auth/signin', $req_param);

  //       // return $response;

  //       // if(isset($response['error'])){
  //       //   $request->session()->flash('status', $response['error']);
  //       //   $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
  //       //   return view('pages.auth-login',['pageConfigs' => $pageConfigs]);
  //       // }else{
  //       //   // Session::set('accessToken', $response['accessToken']);
  //       //   // Session::set('userdata', $response['user']);

  //       //   // $data = session()->all();
  //       //   // var_dump($data);
  //       //   // Session::put('set_accessToken', $response['accessToken']);
  //       //   // Session::put('set_userdata', $response['user']);
  //       //   // Session::put('set_menu', $response['menu']);
  //         // Session::put('isLogin', $response);
  //         $request->session()->put('isLogin', $response);

  //       //   // Session::get('accessToken');
  //       //   // echo "<pre>";
  //       //   // $userData = $request->session()->get('userdata');
  //       //   // $menus = $request->session()->get('menu');
  //       //   // var_dump($menus);
  //       //   // echo $userData['pernr'];
  //       //   // print_r($request->session()->get('accessToken'));  
  //       //   return $response;
  //         return redirect('/');
  //       // }
  //   }

    public function logout(Request $request){
      $request->session()->flush();
      return redirect('/auth-login');
    }
}
