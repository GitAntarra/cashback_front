<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->HttpRequest = new HttpRequest;
	}

  //user List
  public function listUser(Request $request){

    $param = [
      'page'  => 2,
      'limit' => 1
    ];
    $data_user = $this->HttpRequest->service("GET", "/users/shows", $param);
    $type = [
      'HEADER'  => 'HEADER',
      'MAIN'    => 'MAIN',
      'OPTION'  => 'OPTION'
    ];
    $data = [
      'msg'   => '',
      'users' => $data_user,
    ];
    return view('users.page-users-list')->with($data);
  }

  public function getEmployeeId(Request $request)
  {
    $param = [
      'pernr' => $request->post('pernr')
    ];
    $result = $this->HttpRequest->service("GET", "/auth/brillian?pernr=".$request->post('pernr'),$param);

    return $result;

    // if (isset($result)) {
    //   if($result['uker']){
      
    //     $data = array(
    //       'error'         => false,
    //       'pernr'         => $result['pernr'],
    //       'name'		      => $result['name'],
    //       'uker'		      => $result['uker'],
    //       'gender'        => $result['gender'],
    //       'position'		  => $result['position'], 
    //       'division'	    => $result['division'],
    //       'branch'	      => $result['branch'], 
    //       'region_name' => $result['rgdesc'],
    //       'region_code'   => $result['region'],
    //       'msg'           => 'user ditemukan'
    //     );
    //   }else{
    //     $data = array(
    //       'error'  => true,
    //       'data' => null,
    //       'msg' => 'unit kerja user tidak ditemukan'
    //     );

    //   }
    // } else {
    //   $data = array(
    //     'error'  => true,
    //     'pernr' => '',
    //     'msg'   => 'Data tidak ditemukan | pastikan pn dan uker terdaftar',
    //   );
    // }

    echo json_encode($data);
  }

  //User Add
  public function addUser(Request $request){
    $data = array();
    $data['opt_level'] = [
      'MAKER'         => 'MAKER',
      'CHECKER'       => 'CHECKER',
      'SIGNER'        => 'SIGNER',
      'ADMINISTRATOR' => 'ADMINISTRATOR',
      'SUPERADMIN'    => 'SUPERADMIN',
      'DEVELOPER'     => 'DEVELOPER'
    ];
    $data['selectedLevel'] = "MAKER";
    return view('users.page-users-add')->with($data);
  }
  //user view
  public function viewUser(Request $request){
    $user_id = $request->get('id');

    $param = [
      'id' => $user_id
    ];

    $detail_user = $this->HttpRequest->service("GET", "/users/".$param['id']."/detail", $param);
    $data = [
      'detail_user' => $detail_user,
    ];
    // echo "<pre>";
    // print_r($detail_user);
    // die;


    return view('users.page-users-view')->with($data);
  }

  public function saveUser(Request $request)
  {
    $data_user = Session::get('set_userdata');

    $param = [
      'pernr' => $request->post('pernr'),
      'level' => $request->post('level'),
      'status' => "ACTIVED",
      'description' => $request->post('description'),
    ];
    
    $result = $this->HttpRequest->service("POST", "/users/register", $param);
    
    if(isset($result['statusCode'])){
      return redirect('/user-management')->with(['error' => $result['message']]);
    }else{
      return redirect('/user-management')->with(['success' => 'Successfully Add Users']);
    }
  }

   //user edit
   public function editUser(Request $request){
    $data = array();
    $opt_level = [
      'MAKER'         => 'MAKER',
      'CHECKER'       => 'CHECKER',
      'SIGNER'        => 'SIGNER',
      'ADMINISTRATOR' => 'ADMINISTRATOR',
      'SUPERADMIN'    => 'SUPERADMIN',
      'DEVELOPER'     => 'DEVELOPER'
    ];

    $opt_status = [
      'ACTIVED'   => 'ACTIVED',
      'SUSPEND'   => 'SUSPEND',
      'INACTIVE'  => 'INACTIVE',
    ];
    
    $user_id = $request->get('id');
    $param = [
      'id' => $user_id
    ];
    $detail_user = $this->HttpRequest->service("GET", "/users/".$param['id']."/detail", $param);

    $data = [
      'detail_user'   => $detail_user,
      'opt_level'     => $opt_level,
      'selectedLevel' => "MAKER",
      'opt_status'    => $opt_status,
      'selectedStatus'=> "ACTIVED",
    ];

    // echo "<pre>";
    // print_r($detail_user);
    // die;
    return view('users.page-users-edit')->with($data);
  }

  public function saveUpdate(Request $request)
  {

    $param = [
      'level' => $request->get('level'),
      'status' => $request->get('status'),
      'description' => $request->get('description'),
    ];

    // echo "<pre>";
    // print_r($param);
    // echo $request->get('id');
    // die;

    $result = $this->HttpRequest->service("PATCH", "/users/".$request->get('id')."/update", $param);
    
    if(isset($result['statusCode'])){
      return redirect('/user-management')->with(['error' => $result['message']]);
    }else{
      return redirect('/user-management')->with(['success' => 'Successfully Edit Users']);
    }
  }
}
