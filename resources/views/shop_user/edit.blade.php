@extends('default')
@section('contents')
<h1>修改个人密码</h1>
@include('_errors')
{{--<form action="{{route('shop_users.update',[$shop_user])}}" method="post">--}}
    {{--<div class="form-group">--}}
        {{--<label for="">名称 ：</label>--}}
        {{--<input class="form-control" type="hidden" name="name"  value="{{$shop_user->name}}">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label for="">邮箱 ：</label>--}}
        {{--<input class="form-control" type="hidden" name="email" value="@if(old('email')){{old('email')}}@else{{$shop_user->email}}@endif">--}}
    {{--</div>--}}

<div class="form-group">
    <label for="">旧密码 ：</label>
    <input class="form-control" type="text" name="oldpassword">
</div>
    <div class="form-group">
        <label for="">密码 ：</label>
        <input class="form-control" type="text" name="password">
    </div>
    <div class="form-group">
        <label for="">确认密码 ：</label>
        <input class="form-control" type="text" name="password_confirmation">
    </div>


    {{--<div class="form-group">--}}
{{--<label for="">状态 ：</label>--}}
{{--显示：<input  type="radio" name="status" disabled value="1" {{$shop_user->status==1?'checked':'0'}}>--}}
{{--隐藏：<input  type="radio" name="status" disabled value="0" {{$shop_user->status==0?'checked':'0'}}>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
    {{--<label for="">所属商家 ：</label>--}}
    {{--<input class="form-control" type="text" disabled name="shop_id" value="@if(old('shop_id')){{old('shop_id')}}@else{{$shop_user->shop_id}}@endif">--}}
{{--</div>--}}
{{method_field('PATCH')}}
    {{csrf_field()}}
    <button class="btn btn-primary">提交</button>
</form>
@stop