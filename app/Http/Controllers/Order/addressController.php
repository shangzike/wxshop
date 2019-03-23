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
        return view('address');
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

        if($data['is_detail']==true){
            $data['is_detail']=1;
        }else{
            $data['is_detail']=2;
        }
       // $data['user_id']=$user_id;
        var_dump($data);
        die;
        $res=DB::table('shop_address')->insert($data);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
