<?php

namespace App\Http\Controllers;

use App\Models\v2\RegExtendInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    //登录
    public function index()
    {
        return view('login');
    }
    //检测登录
    public function do(Request $request)
    {
        $user_name=$request->user_name;
        $user_pwd=$request->user_pwd;
        if($request->code!=session('verifycode')){
            return 3;die;
        }
        $res=DB::table('shop_user')->where(['user_name'=>$user_name])->first();
        if($res){
            //用户名正确
            if(decrypt( $res->user_pwd)==$user_pwd){
                $user_id=$res->user_id;
                session(['user_id'=>$user_id,'user_name'=>$res->user_name]);
                //密码正确
                return 1;
            }else{
                //密码错误
                return 2;
            }
        }else{
            //用户名错误
            return 2;
        }
    }

    public function phone(Request $request)
    {
        $phone=$request->phone;
        $phonecode=$this->createcode(4);
        $time=time();
        session(['phonecode'=>$phonecode,'phone'=>$phone,'time'=>$time]);
        $res=$this->sendMobile($phonecode,$phone);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    
    //
    public static function createcode($len)
    {
        $code = '';
        for($i=1;$i<=$len;$i++){
            $code .=mt_rand(0,9);
        }
        return $code;
    }

    public function sendMobile($phonecode,$phone){
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        //$code = Common::createcode(4);
        //session(['mobilecode'=>$code]);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$phonecode."，3分钟内有效！&mobile=".$phone;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
}
