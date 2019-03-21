<?php

namespace App\Http\Controllers;

use App\Models\v2\RegExtendInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Goods;
class AllshopsController extends Controller
{
    //全部商品
    public function index()
    {
        $cateInfo=DB::table('shop_cate')->where('pid',0)->get();
        $res=DB::table('shop_goods')->get();
        return view('allshops',['res'=>$res,'cateInfo'=>$cateInfo]);
    }
    //分类信息
    public function cate(Request $request)
    {

        $cate_data=DB::table('shop_cate')->get();
        $cate_id=$request->cate_id;
        $content=$request->content;
        if(empty($content)){
            if($cate_id==0){
                $goods_data=DB::table('shop_goods')->get();
                return view('div',['goods_data'=>$goods_data]);
            }else{
                $category_id=$this->cateInfoPid($cate_data,$cate_id);
                $goods_data=DB::table('shop_goods')->whereIn('cate_id',$category_id)->get();
                return view('div',['goods_data'=>$goods_data]);
            }
        }else{
            $goods_data=DB::table('shop_goods')->where('goods_name','like',"%$content%")->get();
            return view('div',['goods_data'=>$goods_data]);
        }
    }
        private function cateInfoPid($info,$pid){
            static $data=[];
            foreach($info as $v){
                if($v->pid==$pid){
                    $data[]=$v->cate_id;
                    $this->cateInfoPid($info,$v->cate_id);
                }
            }
            return $data;
    }

    //点击排序搜索
    public function sortshop(Request $request)
    {
        $data=$request->all();
        var_dump($data);
    }
}
