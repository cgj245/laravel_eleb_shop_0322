@extends('default')
@section('contents')
@include('_errors')
    <a href="{{route('menu_cates.create')}}"><h3>添加菜品分类</h3></a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>菜品类名</th>
            <th>描述</th>
            <th>所属商家</th>
            <th>是否是默认分类</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        @foreach($menuCates as $menuCate)
            <tr>
                <td>{{$menuCate->id}}</td>
                <td>{{$menuCate->name}}</td>
                <td>{{$menuCate->description}}</td>
                <td>{{$menuCate->shop->shop_name}}</td>
                <td>{{$menuCate->is_selected==1?'是':'否'}}</td>
                <td>{{$menuCate->created_at}}</td>
                <td>{{$menuCate->updated_at}}</td>
                <td>
                    <a href="{{route('menu_cates.edit',[$menuCate])}}" class="btn btn-primary">编辑</a>
                    <span><form action="{{route('menu_cates.destroy',[$menuCate])}}" method="post" style="display:inline">
                        {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button  class="btn btn-danger">删除</button>
                    </form></span>
                </td>
    </tr>
            @endforeach
    </table>
    @stop