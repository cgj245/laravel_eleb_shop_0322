@extends('default')
@section('contents')
    <h3>菜品</h3>
    <a href="{{route('menus.create')}}"><h3>添加菜品</h3></a>
    <p>菜品分类：<select name="cate" id="">
    @foreach($cates as $cate)
                <a href="{{route('menus.index')}}"><option value="{{$cate->id}}">{{$cate->name}}</option></a>
    @endforeach
    </select></p>
    <form action="{{route('menus.index')}}" method="get">

        <p>菜品：<input type="text" name="keyword">
        最小价格：<input type="text" name="pricemin">
        最大价格：<input type="text" name="pricemax">
        {{csrf_field()}}
        <input type="submit" value="提交"></p>
    </form>


<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>评分</th>
        <th>所属商家ID</th>
        <th>所属菜品分类</th>
        <th>价格</th>
        <th>描述</th>
        <th>月销量</th>
        <th>商品图片</th>
        <th>操作</th>
    </tr>
    @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->rating}}</td>
            <td>{{$menu->shop->shop_name}}</td>
            <td>{{$menu->menucate->name}}</td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->month_sales}}</td>
            <td><img src="{{$menu->goods_img}}" width="50px" height="50px" alt=""></td>
            <td>
                <a href="{{route('menus.edit',[$menu])}}" class="btn btn-primary">编辑</a>
                <span><form action="{{route('menus.destroy',[$menu])}}" method="post" style="display:inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button  class="btn btn-danger">删除</button>
                    </form></span>
            </td>
        </tr>
        @endforeach
</table>
    {{$menus->appends($data)->links()}}
@stop