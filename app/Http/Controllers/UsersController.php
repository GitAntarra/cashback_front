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

    $page = $request->get('page') ? $request->get('page') : 1;
    $limit = $request->get('limit') ? $request->get('limit') : 5;
    $status_filter = $request->post('statusFilter')  ? $request->post('statusFilter') : 'ALL';
    $level_filter = $request->post('levelFilter') ? $request->post('levelFilter') : 'ALL';
    $key  = $request->post('keyword') ? $request->post('keyword') : '';

    $url_api = env('API_URL');

    $type = [
      'HEADER'  => 'HEADER',
      'MAIN'    => 'MAIN',
      'OPTION'  => 'OPTION'
    ];

    $nextPage = (int) $page + 1;
    $prevPage = (int) $page - 1;

    $data_user = $this->HttpRequest("GET", "/users?page=".$page."&take=".$limit."&level=".$level_filter."&status=".$status_filter."&keyword=".$key, null)->json();

    $data = [
      'msg'   => '',
      'users' => $data_user,
      'meta'  => (object) $data_user['meta'],
      'limit' => $limit,
      'page'  => $page,
      'status_filter'    => $status_filter,
      'level_filter'  =>$level_filter,
      'keyword'   => $key,
      'nextPage'  => $nextPage,
      'prevPage'  => $prevPage, 
      'number'    => (int) ($page * $limit) - ($limit - 1),
   ];

    $data['status'] = [
      'ALL'       => 'ALL',
      'ACTIVED'   => 'ACTIVE',
      'SUSPEND'   => 'SUSPEND',
      'INACTIVE'  => 'INACTIVE'
    ];

    $data['opt_level'] = [
      'ALL'           => 'ALL',
      'MAKER'         => 'MAKER',
      'CHECKER'       => 'CHECKER',
      'SIGNER'        => 'SIGNER',
      'ADMINISTRATOR' => 'ADMINISTRATOR',
      'SUPERADMIN'    => 'SUPERADMIN',
      'DEVELOPER'     => 'DEVELOPER'
    ];  

    return view('settings.users.page-users-list')->with($data);
  }

  public function getEmployeeId(Request $request)
  {
    $param = [
      'pernr' => $request->post('pernr')
    ];
    $result = $this->HttpRequest->get_detail_pekerja($request->post('pernr'));
    
    return $result;
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
    return view('settings.users.page-users-add')->with($data);
  }
  //user view
  public function viewUser(Request $request){
    $user_id = $request->get('id');

    $param = [
      'id' => $user_id
    ];

    $detail_user = $this->HttpRequest("GET", "/users/".$param['id']."/detail", $param)->json();
    $data = [
      'detail_user' => $detail_user,
    ];

    return view('settings.users.page-users-view')->with($data);
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
    
    $result = $this->HttpRequest("POST", "/users/register", $param);
    
    if(isset($result['statusCode'])){
      return redirect('/user-management')->with(['error' => $result['message']]);
    }else{
      return redirect('/user-management')->with(['success' => 'Successfully Add Users']);
    }
  }

  public function registerUser(Request $request){
    $param = [
      'pernr' => $request->post('pernr'),
      'level' => "ADMINISTRATOR",
      'status' => "INACTIVE",
      'description' => $request->post('description'),
    ];
    
    $result = $this->HttpRequest->service("POST", "/users/register", $param);
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
      'selectedLevel' => $detail_user['level'] ? $detail_user['level'] : "",
      'opt_status'    => $opt_status,
      'selectedStatus'=> $detail_user['status'] ? $detail_user['status'] : "",
    ];
    return view('settings.users.page-users-edit')->with($data);
  }

  public function saveUpdate(Request $request)
  {

    $param = [
      'level' => $request->get('level'),
      'status' => $request->get('status'),
      'description' => $request->get('description'),
    ];

    $result = $this->HttpRequest->service("PATCH", "/users/".$request->get('id')."/update", $param);
    
    if(isset($result['statusCode'])){
      return redirect('/user-management')->with(['error' => $result['message']]);
    }else{
      return redirect('/user-management')->with(['success' => 'Successfully Edit Users']);
    }
  }
}
