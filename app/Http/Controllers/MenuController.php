<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Redirect;
use Session;

class MenuController extends Controller
{

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
}