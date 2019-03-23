<?php

namespace App\Http\Controllers;

use App\Models\v2\RegExtendInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShopCartController extends Controller
{
    //购物车
    public function index()
    {
        $user_id=session('user_id');
        $res=DB::table('shop_cart')
            ->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')
            ->where(['user_id'=>$user_id,'cart_status'=>1])
            ->orderBy('cart_id','desc')
            ->get();
        return view('shopcart',['res'=>$res]);
    }
    
    //加入购物车
    public function add(Request $request)
    {
        $goods_id=$request->goods_id;
        var_dump($goods_id);die;
        $user_id=session('user_id');
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'cart_status'=>1
        ];
        $res=DB::table('shop_cart')->where($where)->first();
        $goodsInfo=DB::table('shop_goods')->where(['goods_id'=>$goods_id])->first();
        if($res){
            //购物车已存在
            //判断是否超过库存
            $buy_number=$res->buy_number+1;
            $this->goodsnum($goodsInfo->goods_num,$buy_number);
            $num=[
                'buy_number'=>$buy_number
            ];
            $cartInfo=DB::table('shop_cart')->where($where)->update($num);

        }else{
            //商品未加入购物车
            $this->goodsnum($goodsInfo->goods_num,1);
            $data=[
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
                'buy_number'=>1
            ];
            $cartInfo=DB::table('shop_cart')->insert($data);
        }
        if($cartInfo){
            return 1;
        }else{
            return 2;
        }
    }

    //判断是否超过库存
    //$goods_num:商品的数量
    //$cart_num :购物车+本次购买的数量
    public function goodsnum($goods_num,$cart_num)
    {
        if($cart_num>$goods_num){
            echo  3;
            die;
        }
    }
    
    //删除
    public function del(Request $request)
    {
        $cart_id=$request->cart_id;
        $cart_id=explode('.',$cart_id);
        $res=DB::table('shop_cart')->whereIn('cart_id',$cart_id)->update(['cart_status'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
