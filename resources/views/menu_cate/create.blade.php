@extends('default')
@section('contents')
<h1>添加菜品分类</h1>
@include('_errors')
<form action="{{route('menu_cates.store')}}" method="post">
    <div class="form-group">
        <label for="">菜品类名 ：</label>
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label for="">描述 ：</label>
        <input class="form-control" type="text" name="description" value="{{old('description')}}">
    </div>
    <div class="form-group">

        <input class="form-control" type="hidden"  name="shop_id" value="{{auth()->user()->shop_id}}">
    </div>

    <div class="form-group">
        <label for="">是否是默认分类 ：</label>
        是：<input  type="radio" name="is_selected" value="1" checked>
        否：<input  type="radio" name="is_selected" value="0">
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn btn-primary">提交</button>
</form>
@stop