<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;


class MenuController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;  
    }

    public function selectionmenu(Request $request) {
        $res = $this->HttpRequest("GET", "/menus/selected");
        $getPost = $request->post();
        $uker = $getPost['uker'] ? $getPost['uker'] : 'Kantor Pusat';
        $level = $getPost['level'] ? $getPost['level'] : 'SUPERADMIN';

        if( isset( $getPost['id'] ) ){
            $param = array(
                "id" => $getPost['id'],
                "uker" => $getPost['uker'],
                "level" => $getPost['level'],
            );
            $resChecked = $this->HttpRequest("POST", "/menus/check-uncheck", $param);
            if(empty($resChecked->ok())){
                Session::flash('success','action success');
            }else{
                return $res;
            }
        }

        if(!empty($res->json())){
            $i=0;
            $mtp = array();
            foreach($res->json() as $row){
                $checked = 0;
                $idSelected = null;
                foreach($row['menuSelected'] as $b){
                if($b['uker']== $uker && $b['level']==$level){
                    $checked = 1;
                    $idSelected = $b['id'];
                }
                }
                $mtp[$i++] = array(
                "id" => $row['id'],
                "type" => $row['type'],
                "name" => $row['name'],
                "url" => $row['url'],
                "i18n" => $row['i18n'],
                "icon" => $row['icon'],
                "checked" => $checked,
                "idselected" => $idSelected
                );
            }
            $data['lists'] = $mtp;
            $data['pageConfigs'] = ['pageHeader' => true];
            $data['breadcrumbs'] = [
                ["link" => "/", "name" => "Home"],["name" => "Selecting Menu"]
            ];
            return view('menus.menu-select-list',$data);
        }

        return $res;
    }

    //Menu List
    public function listMenu(Request $request){

    $data_menu = $this->HttpRequest->service("GET", "/menus/show", null);
    $type = [
        'HEADER'  => 'HEADER',
        'MAIN'    => 'MAIN',
        'OPTION'  => 'OPTION'
      ];
    
    $data = [
        'msg'   => '',
        'menus' => $data_menu,
        'opt_type'      => $type,
        'selectedType'   => 'HEADER'
    ];
    // echo "<pre>";
    // print_r($data['menus']);
    // die;

    return view('menu.menu-list')->with($data);
    }

    //Show Option Menu
    public function showOption(Request $request)
    {
        $id_menu = $request->post('data');
        $data_menu = $this->HttpRequest->service("GET", "/menus/show", null);
        $opt_menu = array();
        foreach($data_menu as $row){
            if($row['id'] == $id_menu){
                $opt_menu = $row['submenu'];
            }
        }
        // for($i = 0; $i < count($opt_menu); $i++ ){
        //     echo $opt_menu[$i]['type'];
        // }die;
        
        if(isset($opt_menu)){
            for($i = 0; $i < count($opt_menu); $i++ ){
                echo "<tr>";
                echo "<td>{$opt_menu[$i]['type']}</td>";
                  echo "<td><p class='detail_href'>{$opt_menu[$i]['name']}</p></td>";
                  echo "<td><a href='#!'><i class='bx bx-edit-alt'></i></a></td>";
                echo "</tr>";
            }
        }
    }

    public function selectedMenu(Request $request)
    {
        return view('menu.menu-selected');
    }
}