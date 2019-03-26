<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class buyrecordController extends Controller
{
    //潮购记录
    public function buyrecord()
    {
        return view('buyrecord');
    }
}
