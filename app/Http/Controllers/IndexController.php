<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    //首页
    public function index()
    {
        //最热商品
        $where=[
            'is_hot'=>1
        ];
        $data=DB::table('shop_goods')->where($where)->orderBy('update_time','desc')->paginate(2);
        //全部商品
        $res=DB::table('shop_goods')->get();
        //分类
        $cateInfo=DB::table('shop_cate')->where('pid',0)->paginate(5);

        return view('index',['data'=>$res,'res'=>$data,'cateInfo'=>$cateInfo]);
    }
    //详情
    public function shopcontent($goods_id)
    {
        $where=[
            'goods_id'=>$goods_id
        ];$res=DB::table('shop_goods')->get();
        $res=DB::table('shop_goods')->where($where)->first();
        return view('shopcontent',['res'=>$res]);
    }
}
