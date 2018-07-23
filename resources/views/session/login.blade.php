
@extends('default')
@section('contents')
         <form method="POST" action="{{route('login')}}" style="margin-left: 40% ">
             <h1>登录</h1>
             @include('_errors')
      <div class="form-group">
          <label for="name">账号：
         <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="请输入账户号">
        </label>
             </div>
       <div class="form-group">
      <label for="password">密码：
     <input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="请输入密码"></label>
     </div>
             <div class="form-group">
                 <label for="password">确认密码：
                     <input type="password" name="repassword" class="form-control" value="{{old('repassword')}}" placeholder="请输入确认密码"></label>
             </div>
             <div class="checkbox">
                 <label><input type="checkbox" name="remember" value="1"> 记住我</label>
             </div>
       <div class="form-group">
          <label for="">验证码 ：
            <input id="captcha" class="form-control" name="captcha" >
           <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></label>
        </div>
             {{ csrf_field()}}
     <button type="submit" class="btn btn-primary">登录</button>

   </form>

@stop