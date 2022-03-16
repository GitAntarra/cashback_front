<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;

class VoucherController extends Controller
{
    public function __construct()
  {
    $this->HttpRequest = new HttpRequest;
	}
}
