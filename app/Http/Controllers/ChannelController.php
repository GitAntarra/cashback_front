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
        return view('channel.channel-list');
    }
}
