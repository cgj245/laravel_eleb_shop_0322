@extends('default')
@section('contents')

    <h3>菜品销量</h3>
    <form action="{{route('menuCount')}}" method="get">
        开始时间：<input type="datetime-local" name="start_time">
        结束时间：<input type="datetime-local" name="end_time">
        {{csrf_field()}}
        <input type="submit" value="查询菜品销量"></p>
    </form>
    <table class="table table-bordered">
        <tr>
            <td>名称</td>
            <td>图片</td>
            <td>价格</td>
            <td>数量</td>
        </tr>
        @foreach($menus as $menu)
            <tr>
            <td>{{$menu->goods_name}}</td>
            <td><img src="{{$menu->goods_img}}" alt="" width="50px"></td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->amount?$menu->amount:0}}</td>
            </tr>
            @endforeach
    </table>
    <a href="{{route('menus.index')}}"> <button class="btn btn-primary">返回</button></a>
@stop