<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    // Top画面表示
    public function index() {
         return view('top');
    }
}
