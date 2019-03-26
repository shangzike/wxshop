@extends('master')
@section('title')
    乐美
@endsection
@section('content')
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">潮购记录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="buycart"></i></a>
</div>
<div class="recordwrapp" style="display: none">
    <div class="buyrecord-con clearfix">
        <div class="record-img fl">
            <img src="images/goods2.jpg" alt="">
        </div>
        <div class="record-con fl">
            <h3>(第<i>87390潮</i>)伊利 安慕希希腊风味酸奶 原味205gX12盒</h3>
            <p class="winner">获得者：<i>终于中了一次</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">2017-06-30 11:11:11</p>
                    <p class="w-chao">第<i>23568</i>潮正在进行中...</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
            

        </div>
    </div>
    <div class="buyrecord-con clearfix">
        <div class="record-img fl">
            <img src="images/goods2.jpg" alt="">
        </div>
        <div class="record-con fl">
            <h3>(第<i>87390潮</i>)伊利 安慕希希腊风味酸奶 原味205gX12盒</h3>
            <p class="winner">获得者：<i>终于中了一次</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">2017-06-30 11:11:11</p>
                    <p class="w-chao"><i>23568</i>潮正在进行中...</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
            

        </div>
    </div>
</div>

<div class="nocontent">
    <div class="m_buylist m_get">
        <ul id="ul_list">
            <div class="noRecords colorbbb clearfix">
                <s class="default"></s>您还没有购买商品哦~
            </div>
            <div class="hot-recom">
            </div>
        </ul>
    </div>
</div>


@endsection

@section('my-js')

@endsection