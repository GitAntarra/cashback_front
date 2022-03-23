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
            if($getmenus->status() == 201){
                Session::flash('success', 'menu selected/unselected');
            }
        }
        
        if(isset($getPost['sorted'])){

            $param = array();
            $i=0;
            foreach($getPost['menusort'] as $row => $key){
                $param[$i++] = array(
                    "id"    => $key,
                    "order"  => $row,
                );
            }
            $getmenus = $this->HttpRequest("POST", "/menus/ordered", $param);
            if($getmenus->status() == 201){
                Session::flash('success', 'menu sorted sucessfull');
            }
        }

        $getmenus = $this->HttpRequest("GET", "/menus/selected");
        $data['lists'] = $this->processmenu($getmenus->json(), $data['selectedUker'] , $data['selectedLevel'] );
        return view('settings.menu.menu-select-list',$data);
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
            $href = array();
            $x=0;
            if($row['type'] == 'OPTION'){
                foreach($data as $child){
                    $ccheked = 0;
                    $cidSelected = null;
                    foreach($child['menuSelected'] as $d){
                        if($d['uker']== $uker && $d['level']==$level){
                            $ccheked = 1;
                            $cidSelected = $d['id'];
                        }
                    }
                    
                    if($child['menuId'] == $row['id']){
                        $href[$x++] = array(
                            "id" => $child['id'],
                            "type" => $child['type'],
                            "name" => $child['name'],
                            "url" => $child['url'],
                            "i18n" => $child['i18n'],
                            "icon" => $child['icon'],
                            "menuId" => $child['menuId'],
                            "order" => $child['order'],
                            "checked" => $ccheked,
                            "idselected" => $cidSelected
                        );
                    }
                }
            }
            if($row['type'] != 'HREF'){
                $mtp[$i++] = array(
                    "id" => $row['id'],
                    "type" => $row['type'],
                    "name" => $row['name'],
                    "url" => $row['url'],
                    "i18n" => $row['i18n'],
                    "icon" => $row['icon'],
                    "menuId" => $row['menuId'],
                    "order" => $row['order'],
                    "checked" => $checked,
                    "idselected" => $idSelected,
                    "child"     => $href
                );
            }
        }

        return $mtp;
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

    return view('settings.menu.menu-list')->with($data);
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