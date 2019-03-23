<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class patmentController extends Controller
{
    //结算
    public function patment(Request $request)
    {
        $cart_id=$request->cart_id;
        echo $cart_id;
    }

    public function pay($cart_id)
    {
        $cart_id=explode('.',$cart_id);
        $res=DB::table('shop_cart')->whereIn('cart_id',$cart_id)->get();
        $goods_id=[];
        foreach ($res as $k=>$v){
            $goods_id[]=$v->goods_id;
        }
        $goodsInfo=DB::table('shop_cart')
            ->join('shop_goods','shop_cart.goods_id','=','shop_goods.goods_id')
            ->whereIn('cart_id',$cart_id)
            ->get();
        $buy_number=0;
        foreach ($goodsInfo as $k=>$v){
            $buy_number+=$v->self_price*$v->buy_number;
        }
        return view('payment',['goodsInfo'=>$goodsInfo,'buy_number'=>$buy_number]);
    }
}
