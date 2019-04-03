@extends('master')
@section('title')
    乐美
@endsection
@section('content')
<body class="g-acc-bg">
    <div>
        @if(empty($user_id))
            <div class="welcome">
                <p>Hi，等你好久了！</p>
                <a href="{{url('login')}}" class="orange">登录</a>
                <a href="{{url('register')}}" class="orange">注册</a>
            </div>
        @else
            <div class="welcome">
                <a href="{{url('set')}}"><i class="set"></i></a>
                <div class="login-img clearfix">
                    <ul>
                        <li><img src="images/goods2.jpg" alt=""></li>
                        <li class="name">
                            <h3>{{session('user_name')}}</h3>
                            <p>ID：{{session('user_id')}}</p>
                        </li>
                        <li class="next fr"><a href="{{url('edituser')}}"><s></s></a></li>
                    </ul>
                </div>
        @endif
    </div>
    <!--获得的商品-->
    
    <!--导航菜单-->
    
    <div class="sub_nav marginB person-page-menu">
        <a href="{{url('buyrecord')}}"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="{{url('mywallet')}}"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="{{url('address/index')}}"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="/v44/help/help.do" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="/v44/help/help.do"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>

<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="{{url('allshops')}}" ><i></i>全部商品</a></li>
        <li class=""><a href="#" ><i></i></a></li>
        <li class="f_car"><a id="btnCart" href="{{url('shopcart')}}" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="{{url('userindex')}}" class="hover"><i></i>我的潮购</a></li>
    </ul>
</div>
@endsection
    <script>
        function goClick(obj, href) {
            $(obj).empty();
            location.href = href;
        }
        if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
            $(".m-block-header").show();
        }
    </script>

