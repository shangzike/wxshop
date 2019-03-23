<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mywalletController extends Controller
{
    //我的钱包
    public function mywallet()
    {
        return view('mywallet');
    }
}
