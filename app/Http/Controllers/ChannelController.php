<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;
	}

    public function listChannel(Request $request)
    {
        $postParam = $request->post();

        $page = $request->get('page') ? $request->get('page') : 1;

        if(isset($postParam['addChannel'])){
            $params = [
                "channel_id"    => $postParam['channelIdAdd'],
                "channel_key"   => $postParam['channelKeyAdd'],
                "status"        => $postParam['statusAdd'],
                "description"    => $postParam['descriptionAdd']
            ];

            $url_add = $this->HttpRequest("POST","/channel",$params);

            if(!empty($url_add)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/list-channel');
        }
        if(isset($postParam['editChannel'])){
            $id = $request->get("channelIdEdit");
            
            $params = [
                "channel_key"   => $postParam['channelKeyEdit'],
                "status"        => $postParam['statusEdit'],
                "description"    => $postParam['descriptionEdit']
            ];
            $url_add = $this->HttpRequest("PUT","/channel/".$id, $params);

            if(!empty($url_add)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/list-channel');

        }

        $list_channel = $this->HttpRequest("GET","/channel?page=".$page, null)->json();

        $data = [
            "data_channel"  => $list_channel['data']
        ];

        return view('channel.channel-list')->with($data);
    }

    public function getChannelById(Request $request)
    {
        $id = $request->get('id');

        $url_view = $this->HttpRequest("GET","/channel/".$id, null)->json();

        return $url_view;
    }

    public function deleteChannel(Request $request)
    {
        $id = $request->get('idChannel');

        $url_delete = $this->HttpRequest("DELETE","/channel/".$id, null);

        return $url_delete;
    }
}
