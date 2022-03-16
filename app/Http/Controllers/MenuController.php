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
    $getPost = $request->post();
    if(isset($getPost['addmenu'])){
        if($getPost['typeMenu'] == "HEADER"){
            $param = [
                'name' => $getPost['menuName'],
            ];
            $url_addMenu = $this->HttpRequest->service("POST","/menus/create-header", $param);

        }else if($getPost['typeMenu'] == "OPTION"){
            $param = [
                'name'  => $getPost['menuName'],
                'i18n'  => $getPost['lngMenu'],
                'icon'  => $getPost['iconMenu']
            ];
            $url_addMenu = $this->HttpRequest->service("POST","/menus/create-main-option", $param);
        }else{
            $param = [
                'name'  => $getPost['menuName'],
                'url'   => $getPost['urlMenu'],
                'i18n'  => $getPost['lngMenu'],
                'icon'  => $getPost['iconMenu'],
                'tagcustom' => $getPost['tagMenu'],
            ];
            $url_addMenu = $this->HttpRequest->service("POST","/menus/create-main-href", $param);
        }

        if(empty($url_addMenu)){
            Session::flash('success','action success');
        }else{
            Session::flash('failed','action failed');
        }
    }
    if(isset($getPost['menuNameSec'])){
        $param = [
            'name'  => $getPost['menuNameSec'],
            'url'   => $getPost['urlMenuSec'],
            'i18n'  => $getPost['lngMenuSec'],
            'icon'  => $getPost['iconMenuSec'],
            'tagcustom' => $getPost['tagMenuSec']
            // 'id'    => $getPost['menuID']
        ];

        $res = $this->HttpRequest->service("POST","/menus/create-second-option", $param);

        if(empty($url_addMenu)){
            Session::flash('success','action success');
        }else{
            Session::flash('failed','action failed');
        }
    }

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
    
    if(isset($getPost['addMenu'])){
        echo "213";
        die;
    }

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
            echo "<tr hidden><td colspan='3'><input class='form-control' name='menuID' id='menuID' type='text' value='".$opt_menu[0]['menuId']."'></td></tr>";
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