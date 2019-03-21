<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    //注册验证
    public function do(Request $request)
    {
        $user_name=$request->user_name;
        $user_pwd=$request->user_pwd;
        $code=$request->code;
        $data=$request->all();
        $data['user_pwd']=encrypt($data['user_pwd']);

        unset($data['_token']);
        $phonecode=session('phonecode');
        $phone=session('phone');
        $time=session('time');
        if($phone!=$user_name){
            //与原手机号不同
            return 5;die;
        }else if($phonecode!=$code){
            //验证码错误
            return 6;die;
        }
        $res=DB::table('shop_user')->where(['user_name'=>$user_name])->first();
        if($res){
            //用户名已注册
            return 3;
        }else{
                unset($data['code']);
                $arr=DB::table('shop_user')->insert($data);
                if($arr){
                    //成功
                    return 1;
                }else{
                    //失败
                    return 4;
                }
        }
    }
}
