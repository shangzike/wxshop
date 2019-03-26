<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Routing\Tests\Fixtures\AnnotationFixtures\DefaultValueController;

class safesetController extends Controller
{
    public function safeset()
    {
        return view('safeset');
    }

    public function loginpwd()
    {
        return view('loginpwd');
    }

    public function pwd(Request $request)
    {
        $user_id=session('user_id');
        if(empty($user_id)){
            return '请先登录再试';die;//请先登录再试
        }
        $data=$request->all();
        $user_pwd=$data['user_pwd'];
        if(empty($user_pwd)){
            return '当前密码不能为空';die;//请先登录再试
        }
        $new_pwd1=$data['new_pwd1'];
        $new_pwd2=$data['new_pwd2'];
        if(empty($new_pwd1)){
            return '新密码不能为空';die;//请先登录再试
        }else if($new_pwd1!=$new_pwd2){
            return '确认密码一致';die;//请先登录再试
        }

        $res=DB::table('shop_user')->where(['user_id'=>$user_id])->first();
        if($res){
            if(decrypt($res->user_pwd)==$user_pwd){
                $new_pwd1=encrypt($new_pwd1);
                $arr=DB::table('shop_user')->where(['user_id'=>$user_id])->update(['user_pwd'=>$new_pwd1]);

                if($arr){
                    $arr2=session(['user_id'=>null]);
                    $arr3=session(['user_name'=>null]);
                    return 1;
                }else{
                    return '修改失败';
                }
            }else{
                return '当前密码错误';die;
            }
        }else{
            return '请先登录';die;
        }
    }
}
