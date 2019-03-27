

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <title>搜索</title>

    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/goods.css')}}" rel="stylesheet" type="text/css" />
</head>
<body class="g-acc-bg m-site-box" fnav="2">
    <input name="hidSearchKey" type="hidden" id="hidSearchKey" value="黄金" />
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header" style="display: block">
    <strong id="m-title">搜索</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <div class="pro-s-box thin-bor-bottom search-box pos-fix-0" id="divSearch">    
        <div class="box">
            <div class="border">
                <div class="border-inner"></div>
            </div>
            <div class="input-box">
                <i class="s-icon"></i>
                <input type="text" placeholder="输入“汽车”试试" value="" id="txtSearch" maxlength="10" />
                <i class="c-icon" id="btnClearInput" style="display: none"></i>
            </div>
        </div>
        <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
    </div>

    <!--搜索结果模块-->
    <div id="loadingPicBlock">
    </div>



<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v47/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v47/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v47/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v47/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v47/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
</body>
</html>
<script>
    $(function () {
        $(document).on('click','#btnSearch',function () {
            var goods_name=$("#txtSearch").val();
            var _token=$("#_token").val();
            if(goods_name==''){
                alert('请输入搜索内容');
                return false;
            }else {
                $.post(
                    "{{url('searchdo')}}",
                    {goods_name: goods_name, _token: _token},
                    function (res) {
                        $("#loadingPicBlock").html(res);
                    }
                )
            }
        })

        $(document).on('click',".cartadd",function () {
            var user_id=$(this).attr('user_id');
            if(user_id!=''){
                var goods_id=$(this).attr('goods_id');
                var _token=$("#_token").val();
                $.post(
                    '{{url('cart/add')}}',
                    {goods_id:goods_id,_token:_token},
                    function (res) {
                        // console.log(1)
                        if(res==1){
                            alert("加入购物车成功");
                            location.href="{{url('shopcart')}}";
                        }else if(res==2){
                            alert("加入购物车失败");
                            location.href="{{url('/')}}";
                        }else if(res==3){
                            alert("超过库存");
                        }
                    }
                )
            }else{
                alert('请先登录');
                location.href="{{url('login')}}";
            }
        })

    })
</script>
