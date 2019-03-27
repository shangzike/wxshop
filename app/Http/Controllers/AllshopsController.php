<?php

namespace App\Http\Controllers;

use App\Models\v2\RegExtendInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Goods;
use think\console\command\make\Model;
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
    
    //首页点击 分类
    public function cateshop($cate_id)
    {
        $cate=DB::table('shop_cate')->where('pid','=',0)->get();
        $arr=$this->cateInfoPid($cate,$cate_id);
        $data=DB::table('shop_goods')->where('is_up','=',1)->whereIn('cate_id',$arr)->orderBy('update_time','desc')->get();
        return view('allshops',['data'=>$data],['cate'=>$cate])
            ->with('id',$cate_id);
    }
    
    //价格 最新
    public function default(Request $request)
    {
        $_type=$request->_type;
        $asc=$request->asc;
        $cate_id=$request->cate_id;
        if($asc=='↑'){
            $asc='asc';
        }else{
            $asc=='desc';
        }
        if($cate_id==0){
            $goods_data=DB::table('shop_goods')->orderBy($_type,$asc)->get();
        }else{
            $cate_data=DB::table('shop_cate')->get();
            $category_id=$this->cateInfoPid($cate_data,$cate_id);
            $goods_data=DB::table('shop_goods')->whereIn('cate_id',$category_id)->orderBy($_type,$asc)->get();
        }

        return view('div',['goods_data'=>$goods_data]);
    }
    
    //搜索
    public function search()
    {
        return view('search');
    }

    public function searchdo(Request $request)
    {
        $goods_name=$request->goods_name;
        $goodsModel=new Goods;
        $goods_data=$goodsModel::where('goods_name','like',"%$goods_name%")->get();
        return view('searchdiv',['goods_data'=>$goods_data]);
    }
}
