<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class addressController extends Controller
{
    //收货地址

    public function index()
    {
        $user_id=session('user_id');
        $data=DB::table('shop_address')->where(['user_id'=>$user_id,'address_status'=>1])->get();
        return view('address',['data'=>$data]);
    }
    
    //添加收货地址
    public function writeaddr()
    {

        return view('writeaddr');
    }

    public function add(Request $request)
    {
        $data=$request->all();

        unset($data['_token']);

        $user_id=session('user_id');
        if($data['address_name']==''){
            return '姓名不能为空'; die;
        }
        if($data['address_tel']==''){
            return '电话不能为空';die;
        }
        if($data['area']==''){
            return '所在区域不能为空';die;
        }
        if($data['address_detail']==''){
            return '详细不能为空';die;
        }
        $data['user_id']=$user_id;
        if($data['is_default']==true){
            $data['is_default']=1;
            $arr=DB::table('shop_address')->where(['user_id'=>$user_id])->update(['is_default'=>2]);
            $res=DB::table('shop_address')->insert($data);
            if($arr!==false&&$res){
                return '添加成功';
            }else{
                return  '添加失败';
            }
        }else{
            $data['is_default']=2;
            $res=DB::table('shop_address')->insert($data);
            if($res){
                return  '添加成功';
            }else{
                return '添加失败';
            }
        }
    }
    
    //删除
    public function del(Request $request)
    {
        $address_id=$request->address_id;
        $res=DB::table('shop_address')->where(['address_id'=>$address_id])->update(['address_status'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    
    
    //修改
    public function edit($address_id)
    {
        $res=DB::table('shop_address')->where(['address_id'=>$address_id])->first();
        return view('editdo',['res'=>$res]);
    }

    //修改执行
    public function editdo(Request $request)
    {
        $data=$request->all();
        $address_id=$data['address_id'];
        unset($data['_token']);
        $user_id=session('user_id');
        if($data['address_name']==''){
            return '姓名不能为空'; die;
        }
        if($data['address_tel']==''){
            return '电话不能为空';die;
        }
        if($data['area']==''){
            return '所在区域不能为空';die;
        }
        if($data['address_detail']==''){
            return '详细不能为空';die;
        }
        //var_dump($data);die;
        $data['user_id']=$user_id;
        if($data['is_default']==2){
            $res=DB::table('shop_address')->where(['address_id'=>$address_id])->update($data);
            if($res){
                return  '修改成功';
            }else{
                return '修改失败';
            }
        }else{
            $arr=DB::table('shop_address')->where(['user_id'=>$user_id])->update(['is_default'=>2]);
            $res=DB::table('shop_address')->where(['address_id'=>$address_id])->update($data);
            if($arr!==false&&$res){
                return '修改成功';
            }else{
                return  '修改失败';
            }
        }
    }
    
    //设为默认
    public function setdefalt(Request $request)
    {
        $address_id=$request->address_id;
        $user_id=session('user_id');
        $where=[
            'address_id'=>$address_id,
            'user_id'=>$user_id
        ];
        $arr=DB::table('shop_address')->where(['user_id'=>$user_id])->update(['is_default'=>2]);
        $res=DB::table('shop_address')->where($where)->update(['is_default'=>1]);
        if($arr&&$res){
            return 1;
        }else{
            return 2;
        }
    }
}
