<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/cartlist.css" rel="stylesheet" type="text/css" />
</head>
<body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            @if(empty($res))
            <div id="divNone" class="empty "  style="display: none">
                <s></s><p>您的购物车还是空的哦~</p>
                <a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a>
            </div>
            @else
                <ul id="cartBody">
                    @foreach($res as $v)
                    <li>
                        <s class="xuan current" ></s>
                        <a class="fl u-Cart-img" href="#，">
                            <img src="{{$v->goods_img}}" border="0" alt="">
                        </a>
                        <div class="u-Cart-r" cart_id="{{$v->cart_id}}">
                            <a href="{{url('shopcontent')}}/{{$v->goods_id}}" class="gray6">{{$v->goods_name}}</a>
                            <span class="gray9">
                            <em>剩余{{$v->goods_num}}件</em>
                                <em class="self">单价<a id="self_price">{{$v->self_price}}</a>元</em>
                            </span>
                            <div class="num-opt">
                                <em class="num-mius dis min"><i></i></em>
                                <input class="text_box" name="num" maxlength="6" type="text" value="{{$v->buy_number}}" codeid="12501977">
                                <em class="num-add add"><i></i></em>
                            </div>
                            <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del"><s></s></a>
                        </div>
                    </li>
                    @endforeach
                </ul>

            @endif
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="{{url('allshops')}}" ><i></i>全部商品</a></li>
        <li class="f_single"><a href="{{url('share')}}" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="{{url('shopcart')}}" class="hover"><i></i>购物车</a></li>
        <li class="f_personal"><a href="{{url('userindex')}}" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<!---商品加减算总数---->
    <script type="text/javascript">
    $(function () {
        $(".add").click(function () {
            var t = $(this).prev();
            t.val(parseInt(t.val()) + 1);
            GetCount();
        })
        $(".min").click(function () {
            var t = $(this).next();
            if(t.val()>1){
                t.val(parseInt(t.val()) - 1);
                GetCount();
            }
        })
        $(document).on('click',".z-del",function () {
            var cart_id=$(this).parents().attr('cart_id');
            var _token=$("#_token").val();
            $.post(
                '{{url('cart/del')}}',
                {cart_id:cart_id,_token:_token},
                function (res){
                    console.log(res)
                    if(res==1){
                        alert('删除成功');
                        location.href="{{url('shopcart')}}"
                    }else if(res==2){
                        alert('删除失败');
                    }
                }
            )
        })
    })
    </script>



    
    <script>

    // 全选        
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

             $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current"); 
                } else {
                    $(this).addClass("current");
                } 
            });
            GetCount();
        }else{
            $(this).addClass('current');

             $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }
        
        
    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            

            $(this).removeClass('current');

        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
        // $("#total2").html() = GetCount($(this));
        GetCount();
        //alert(conts);
    });
  // 已选中的总额
    function GetCount() {
        var conts = 0;
        var aa = 0;
        var self=$('.self').text();
        $(".g-Cart-list .xuan").each(function () {
            if ($(this).hasClass("current")) {
                for (var i = 0; i < $(this).length; i++) {
                    conts += parseInt($(this).parents('li').find('input.text_box').val())*$('#self_price').text();
                    // aa += 1;
                }
            }
        });
        
         $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();
</script>
</body>
</html>
