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
      'limit' => 5
    ];
    $data_user = $this->HttpRequest->service("GET", "/users/shows", $param);
    $data = [
      'msg'   => '',
      'users' => $data_user,
    ];
    echo "<pre>";
    print_r($data_user);
    die;
    return view('users.page-users-list')->with($data);
  }

  public function saveUser(Request $request)
  {
    // echo 'hallo';
    
    $data_user = Session::get('set_userdata');

    $param = [
      'pernr' => $request->post('pernr'),
      'level' => $request->post('level'),
      'status' => "INACTIVE",
      'description' => $request->post('description'),
    ];

    // return $param;
    
    $result = $this->HttpRequest->service("POST", "/users/register", $param);
    
    if(isset($result['statusCode'])){
      return redirect('/user-management')->with(['error' => $result['message']]);
    }else{
      return redirect('/user-management')->with(['success' => 'Successfully Add Users']);
    }
  }

  public function getEmployeeId(Request $request)
  {
    $post_model = new HttpRequest;
    $param = [
      'pernr' => $request->post('pernr')
    ];
    $result = $post_model->service("GET", "/auth/brillian?pernr=".$param['pernr'], $param);

    if ($result) {
      if($result['uker']){
        // if($this->session->userdata('level_user') != 'SAD'){
        //   if($this->session->userdata('branch_detail')['REGION'] != $result['DETAIL_UKER']['REGION']){
        //     $data = array(
        //       'error'  => true,
        //       'data' => null,
        //       'msg' => 'Region pekerja tidak sesuai dengan region administrator'
        //     );
        //     echo json_encode($data); 
        //     die;
        //   }
        // }
      
        $data = array(
          'error'         => false,
          'pernr'         => $result['pernr'],
          'name'		      => $result['name'],
          'uker'		      => $result['uker'],
          'gender'        => $result['gender'],
          'position'		  => $result['position'],
          'division'	    => $result['division'],
          'branch'	      => $result['branch'], 
          'region_name' => $result['rgdesc'],
          'region_code'   => $result['region'],
          'msg'           => 'user ditemukan'
        );
      }else{
        $data = array(
          'error'  => true,
          'data' => null,
          'msg' => 'unit kerja user tidak ditemukan'
        );

      }
    } else {
      $data = array(
        'error'  => true,
        'pernr' => '',
        'msg'   => 'Data tidak ditemukan | pastikan pn dan uker terdaftar',
      );
    }

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
  public function viewUser(){
    return view('pages.page-users-view');
  }
   //user edit
   public function editUser(){
    return view('pages.page-users-edit');
  }
}
