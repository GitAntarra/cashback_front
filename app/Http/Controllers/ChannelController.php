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
        $take = $request->get("take") ? $request->get("take") : 1;
        echo $request->get("take");

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

        $list_channel = $this->HttpRequest("GET","/channel?page=".$page."&take=".$take, null)->json();

        $nextPage = (int) $page + 1;
        $prevPage = (int) $page - 1;

        $data = [
            "data_channel"  => $list_channel['data'],
            "meta"          => (object) $list_channel['meta'],
            "take"          => $take,
            "page"          => $page,
            "number"        => (int) ($page * $take)-($take -1),
            "prevPage"      => $prevPage,
            "nextPage"      => $nextPage,
            "buttonprev"    => "<button class='page-link'><a href='http://172.18.135.222/cashback/list-channel?page=".$prevPage."&take=".$take."'><i class='bx bx-chevrons-left'></i>Prev</a></button>", 
            "buttonnext"    => "<button class='page-link'><a href='http://172.18.135.222/cashback/list-channel?page=".$nextPage."&take=".$take."'><i class='bx bx-chevrons-right'></i>Next</a></button>", 
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
