<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class UserController extends Controller
{
    //我的
    public function index()
    {
        $user_id=session('user_id');
        return view('userpage',['user_id'=>$user_id]);
    }
    //编辑个人资料
    public function edituser()
    {
        return view('edituser');
    }
    //退出登录
    public function edit(){
        session(['user_name'=>null]);
        session(['user_id'=>null]);
        if(session('user_id')==null&&session('user_name')==null){
            return redirect('/');
        }
    }

    public function set()
    {
        return view('set');
    }
}
