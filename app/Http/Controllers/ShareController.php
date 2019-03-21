<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    //晒单
    public function index()
    {
        return view('share');
    }
}
