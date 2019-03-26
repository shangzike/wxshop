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
                        <s class="xuan current"></s>
                        <a class="fl u-Cart-img" href="#，">
                            <img src="{{$v->goods_img}}" border="0" alt="">
                        </a>
                        <div class="u-Cart-r" cart_id="{{$v->cart_id}}" goods_id="{{$v->goods_id}}">
                            <a href="{{url('shopcontent')}}/{{$v->goods_id}}" class="gray6">{{$v->goods_name}}</a>
                            <span class="gray9">
                            <em>剩余{{$v->goods_num}}件</em>
                                <em class="self">单价
                                    <a class="self_price" self_price="{{$v->self_price}}">{{$v->self_price}}</a>元
                                </em>
                            </span>
                            <div class="num-opt">
                                <em class="num-mius dis min"><i></i></em>
                                <input class="text_box" name="num"  maxlength="6" type="text"
                                  cart_id="{{$v->cart_id}}"     goods_id="{{$v->goods_id}}" value="{{$v->buy_number}}" goods_num="{{$v->goods_num}}" codeid="12501977">
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
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account order">去结算</a>
                </dd>
            </dl>
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

        //加
        $(document).on('click','.num-add',function () {
            var buy_number=parseInt($(this).prev().val());
            var goods_id=$(this).prev().attr('goods_id');
            var goods_num=$(this).prev().attr('goods_num');
            var cart_id=$(this).prev().attr('cart_id');
            // if(buy_number>=goods_num){
            //     alert('库存不足');
            //     _this.prop('disabled',true);
            // }
            cart(cart_id,buy_number)
        })

        //减
        $(document).on('click','.num-mius',function () {
            var buy_number=parseInt($(this).next().val());
            var goods_id=$(this).next().attr('goods_id');
            var goods_num=$(this).next().attr('goods_num');
            var cart_id=$(this).next().attr('cart_id');
            cart(cart_id,buy_number)
        })

        //数量
        $(document).on('blur','.text_box',function () {
            var _this=$(this);
            var buy_number=parseInt($(this).val());
            var goods_id=$(this).attr('goods_id');
            var goods_num=$(this).attr('goods_num');
            var reg=/^[1-9]\d*$/;
            var cart_id=$(this).attr('cart_id');

            if(!reg.test(buy_number)){
                _this.val(1)
            }else if(buy_number<=1){
                _this.val(1)
            }else if(buy_number>=goods_num){
                _this.val(goods_num)
            }else{
                _this.val(buy_number)
            }
            cart(cart_id,buy_number)
        })

        //修改购物车个数
        function cart(cart_id,buy_number){
            var _token=$("#_token").val();
            $.post(
                "{{url('cartnum')}}",
                {cart_id:cart_id,buy_number:buy_number,_token:_token},
                function (res) {
                    console.log(res);
                }

            )
        }



        $('.order').click(function () {
            var cart_id='';
            $('.xuan').each(function () {
                if($(this).attr('class')=='xuan current'){
                    cart_id+=$(this).siblings("div[class='u-Cart-r']").attr('cart_id')+'.'
                }
            })
            cart_id=cart_id.substr(0,cart_id.length-1);
            var _token=$("#_token").val();
            if(cart_id==''){
                alert('请至少选择一个商品');
                location.href="shopcart"
            }
            $.post(
                '{{url('order')}}',
                {cart_id:cart_id,_token:_token},
                function (res) {
                    location.href="{{url('order/pat')}}"+'/'+res;
                }
            )
            //console.log(cart_id)
        })


        //批量删除
        $('.remove').click(function () {
            var cart_id='';
            $(".xuan").each(function () {
                if($(this).attr('class')=='xuan current'){
                    cart_id+=$(this).siblings("div[class='u-Cart-r']").attr('cart_id')+'.';
                }
            });
            if(cart_id==''){
                alert('请至少选择一个商品');
                location.href="shopcart"
            }
            cart_id=cart_id.substr(0,cart_id.length-1);
            var _token=$("#_token").val();
            $.post(
                '{{url('cart/del')}}',
                {cart_id:cart_id,_token:_token},
                function (res){
                    //console.log(res)
                    if(res==1){
                        alert('删除成功');
                        location.href="{{url('shopcart')}}"
                    }else if(res==2){
                        alert('删除失败');
                    }
                }
            )
        })


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
        $(".xuan").each(function () {
            if($(this).attr('class')=='xuan current'){
                var self_price=$(this).siblings("div[class='u-Cart-r']").find("a[class='self_price']").attr('self_price');
                var buy_number=$(this).siblings("div[class='u-Cart-r']").find("input[class='text_box']").val();
                conts+=parseInt(self_price)*parseInt(buy_number);
            }
        });

        $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();

    </script>
</body>
</html>
