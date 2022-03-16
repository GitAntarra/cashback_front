<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;


class MenuController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;  
    }

    public function selectionmenu(Request $request){
        // Get list menu
        

        $getPost = $request->post();
        $data = array();
        $data['selectedUker'] = isset($getPost['uker']) ? $getPost['uker'] : 'Kantor Pusat';
        $data['selectedLevel'] = isset($getPost['level']) ? $getPost['level'] : 'SUPERADMIN';

        $data['pageConfigs'] = ['pageHeader' => true];
        $data['breadcrumbs'] = [
            ["link" => "/", "name" => "Home"],["name" => "Selecting Menu"]
        ];
        $data['opt_level'] = [
            'MAKER'         => 'MAKER',
            'CHECKER'       => 'CHECKER',
            'SIGNER'        => 'SIGNER',
            'ADMINISTRATOR' => 'ADMINISTRATOR',
            'SUPERADMIN'    => 'SUPERADMIN',
            'DEVELOPER'     => 'DEVELOPER'
        ];
        
        $data['opt_uker'] = [
            'Kantor Pusat'      => 'KANTOR PUSAT',
            'Kantor Wilayah'    => 'KANTOR WILAYAH',
            'Kantor Cabang'     => 'KANTOR CABANG',
            'Kantor Unit'       => 'KANTOR UNIT',
            'Kantor Cabang Pembantu' => 'KANTOR CABANG PEMBANTU',
        ];
        if(isset($getPost['id'])){
            $param = array(
                "id"    => $getPost['id'], 
                "uker"  => $getPost['uker'],
                "level" => $getPost['level']
            );
            $getmenus = $this->HttpRequest("POST", "/menus/check-uncheck", $param);
            Session::flash('success', 'action success');
        }
        $getmenus = $this->HttpRequest("GET", "/menus/selected");
        $data['lists'] = $this->processmenu($getmenus->json(), $data['selectedUker'] , $data['selectedLevel'] );

        return view('menu.menu-select-list',$data);
    }

    public function processmenu($data, $uker, $level){
        $i=0;
        $mtp = array();
        foreach($data as $row){
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

        return $mtp;
    }

    public function selectedMenu(Request $request){
        $getPost = $request->post();
        print_r($getPost);
    }


    public function selectionmenus(Request $request) {

        $res = $this->HttpRequest("GET", "/menus/selected");

        try {
            $getPost = $request->post();
            $uker = isset($getPost['uker']) ? $getPost['uker'] : 'Kantor Pusat';
            $level =isset($getPost['level']) ? $getPost['level'] : 'SUPERADMIN';
    
            if( isset( $getPost['id'] ) ){
                $param = array(
                    "id" => $getPost['id'],
                    "uker" => $getPost['uker'],
                    "level" => $getPost['level'],
                );
                print_r($param);
                $resChecked = $this->HttpRequest("POST", "/menus/check-uncheck", $param);
    
                return $resChecked;
                die;
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
                $data['opt_level'] = [
                    'MAKER'         => 'MAKER',
                    'CHECKER'       => 'CHECKER',
                    'SIGNER'        => 'SIGNER',
                    'ADMINISTRATOR' => 'ADMINISTRATOR',
                    'SUPERADMIN'    => 'SUPERADMIN',
                    'DEVELOPER'     => 'DEVELOPER'
                ];
                
                  $data['opt_uker'] = [
                      'KP'  => 'KANTOR PUSAT',
                      'KW'  => 'KANTOR WILAYAH',
                      'KC'  => 'KANTOR CABANG',
                      'KU'  => 'KANTOR UNIT',
                      'KCP' => 'KANTOR CABANG PEMBANTU',
                  ];
                  $data['selectedLevel'] = 'MAKER';
                  $data['selectedUker']  = 'KANTOR PUSAT';
                return view('menus.menu-select-list',$data);
            }
    
            return $res;
        } catch (\Throwable $th) {
            return $res;
        }
        
        
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
}