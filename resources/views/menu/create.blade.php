@extends('default')
@section('contents')
    {{--引入错误提示信息--}}
    @include('_errors')
    <form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data" style="width: 400px">

        <div class="form-group">
            <label>名称:</label>
            <input type="text" class="form-control" name="goods_name" value="{{old('goods_name')}}" placeholder="请输入名称">
        </div>
        <div class="form-group">
            <label>价格:</label>
            <input type="text" class="form-control" name="goods_price" value="{{old('goods_price')}}" placeholder="请输入价格">
        </div>

        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" class="form-control"   rows="3">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="hidden" name="shop_id" value="{{auth()->user()->shop_id}}">
        </div>

        <div class="form-group">
            <label>菜品分类:</label>
            <select name="category_id" id="" class="form-control">
                @foreach($menuCate as $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>商品图片:</label>
            <input type="file" name="goods_img" value="">
        </div>

        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block"> 提交</button>

    </form>
@stop
