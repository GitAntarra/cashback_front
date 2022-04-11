<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class PembukuanController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;  
    }

    public function listPembukuan(){
        return view('app.pembukuan.list-pembukuan');
    }
}
