@extends('master')
@section('title')
    乐美
@endsection
<link rel="stylesheet" href="{{url('css/sm.css')}}">
@section('content')
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('address/writeaddr')}}" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    @foreach($data as $v)
    <div class="addr-list">
         <ul>
            <li class="clearfix">
                <span class="fl">{{$v->address_name}}</span>
                <span class="fr">{{$v->address_tel}}</span>
            </li>
            <li>
                <p>{{$v->area}}{{$v->address_detail}}</p>
            </li>
            <li class="a-set">
                @if($v->is_default==1)
                <s class="z-set" style="margin-top: 6px;"></s>
                @else
                <s class="z-defalt" style="margin-top: 6px;" ></s>
                @endif
                <span class="moren">设为默认</span>
                <div class="fr" address_id="{{$v->address_id}}">
                    <a href="{{url('address/edit')}}/{{$v->address_id}}" class="edit">编辑</a>
                    <span class="remove">删除</span>
                </div>
            </li>
        </ul>  
    </div>
   @endforeach
</div>
@endsection
@section('my-js')





<!-- 单选 -->
<script>
    //设为默认
    $(document).on('click','.moren', function () {
        var address_id=$(this).next('div').attr('address_id');

        var _token=$("#_token").val();
        $.post(
            '{{url('address/setdefalt')}}',
            {address_id:address_id,_token:_token},
            function (res) {
                // console.log(res);
                if(res==1){
                    alert('设置成功');

                }else{
                    alert('设置失败');
                }
                history.go(0);
            }
        )
    })
     // 删除地址
    $(document).on('click','.remove', function () {
        var address_id=$(this).parent().attr('address_id');
        var _token=$("#_token").val();
        $.post(
            "{{url('address/del')}}",
            {address_id:address_id,_token:_token},
            function (res) {
                if(res==1){
                    alert('删除成功')
                    history.go(0);
                }else if(res==2){
                    alert('删除失败')
                }

            }
        )

        // var buttons1 = [
        //     {
        //       text: '删除',
        //       bold: true,
        //       color: 'danger',
        //       onClick: function() {
        //         $.alert("您确定删除吗？");
        //       }
        //     }
        //   ];
        //   var buttons2 = [
        //     {
        //       text: '取消',
        //       bg: 'danger'
        //     }
        //   ];
          // var groups = [buttons1, buttons2];
          // $.actions(groups);
    });
</script>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
            // jquery相关代码
            $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){
                    
                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }   
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
                
            }
        )

    });
    
</script>
@endsection
