<div id="loadingPicBlock">
    <!--搜索有结果时-->
    @if(empty($goods_data))
        <!--搜索无结果时-->
            <div class="null-search-wrapper" id="divNoneData">
                <div class="null-search-inner">
                    <i class="null-search-icon"></i>
                    <p class="gray9">抱歉，没有您想要的商品！</p>
                </div>

                <div class="hot-recom">
                    <div class="title thin-bor-top gray6">人气推荐</div>
                    <div class="goods-wrap thin-bor-top">
                        <ul class="goods-list clearfix" id="ulRec"></ul>
                    </div>
                </div>
            </div>
    @else
        <div class="goodList">
        <ul id="ulGoodsList">
            @foreach($goods_data as $v)
                <li id="23901">
                    <span class="gList_l fl">
                       <img class="lazy" name="goodsImg"  src="{{$v->goods_img}}"/>
                    </span>
                    <div class="gList_r">
                        <h3 class="gray6"><a href="{{url('shopcontent')}}/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                        <em class="gray9">价值：￥{{$v->self_price}}</em>
                        <div class="gRate">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                </p>
                                <ul class="Pro-bar-li">
                                    <li class="P-bar01"><em>7342</em>已参与</li>
                                    <li class="P-bar02"><em>7988</em>总需人次</li>
                                    <li class="P-bar03"><em>{{$v->goods_num}}</em>剩余</li>
                                </ul>
                            </div>
                            <p ><a codeid="12785750" class="cartadd" goods_id="{{$v->goods_id}}"  user_id="{{session('user_id')}}" canbuy="646" src=""></a></p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
</div>
    @endif
</div>