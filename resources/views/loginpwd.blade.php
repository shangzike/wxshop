@extends('master')
@section('title')
    乐美
@endsection
@section('content')
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">修改登录密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



    <div class="wrapper">
        <form class="layui-form" action="">
            <input type="hidden" name="_token"  value="{{csrf_token()}}">
            <div class="registerCon regwrapp">
                <div class="account">
                    <em>账户名：</em> <i>{{session('user_name')}}</i>
                </div>
                <div><em>当前密码</em><input type="password" name="user_pwd"></div>
                <div><em>新密码</em><input type="password" name="new_pwd1" placeholder="请输入6-16位数字、字母组成的新密码"></div>
                <div><em>确认新密码</em><input type="password"  name="new_pwd2" placeholder="确认新密码"></div>
                <div class="save"><span lay-submit="" lay-filter="*">保存</span></div>
            </div>
        </form>
    </div>
@endsection

@section('my-js')
<script>
//Demo
layui.use(['layer','form'], function(){
  var form = layui.form();
  var layer =layui.layer;
  //监听提交
  form.on('submit(*)', function(data){
        //console.log(data.field);
    //layer.msg(JSON.stringify(data.field));
        $.post(
            "{{url('pwd')}}",
            data.field,
            function (res) {
                if(res==1){
                    alert('修改成功')
                    location.href="{{url('login')}}";
                }else{
                    layer.msg(res,{icon:2});
                }
            }
        )
    return false;
  });
});

</script>

@endsection
    