@extends('default')
@section('contents')
    {{--引入错误提示信息--}}
    @include('_errors')
    <form action="{{route('menus.update',[$menu])}}" method="post" enctype="multipart/form-data" style="width: 400px">

        <div class="form-group">
            <label>名称:</label>
            <input type="text" class="form-control" name="goods_name" value="{{old('goods_name')}}" placeholder="请输入名称">
        </div>

        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" id="" cols="30" rows="10">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label>所属商家ID:</label>
            <input class="form-control" type="hidden"  name="shop_id" value="{{auth()->user()->shop_id}}">
        </div>
        <div class="form-group">
            <label>商品图片:</label>
            <input type="file" name="goods_img" value="{{old('goods_img')}}">
        </div>

        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button type="submit" class="btn btn-primary btn-block"> 提交</button>

    </form>
@stop
