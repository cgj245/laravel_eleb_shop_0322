@extends('default')
@section('contents')
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>店铺分类</th>
        <th>商家名称</th>
        <th>店铺图片</th>
        <th>状态</th>
    </tr>
    @foreach($shop as $v)
        <tr>
            <th>{{$v->id}}</th>
            <th>{{$v->shop_category?$v->shop_category->name:'无'}}</th>
            <th>{{$v->shop_name}}</th>
            <th><img src="{{$v->shop_img}}" width="50px" height="50px" alt=""></th>
            <th>@if($v->status==-1)
                禁用
                    @elseif($v->status==0)
                 待审核
                    @else
                    正常
                    @endif
            </th>
            {{--<th>--}}
                {{--<a href="{{route('shops.show',['shop'=>$v])}}" title="查看"  class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                {{--<a href="{{route('shops.create')}}" title="添加" class="btn btn-primary"><span class="glyphicon glyphicon-plus" ></span></a>--}}
                {{--<a href="{{route('shops.edit',[$v])}}" title="编辑"  class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>--}}
                {{--<span><form action="{{route('shops.destroy',[$v])}}" method="post" style="display:inline">--}}
                        {{--{{csrf_field()}}--}}
                        {{--{{method_field('DELETE')}}--}}
                        {{--<button title="删除" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>--}}

                {{--</form></span>--}}

            {{--</th>--}}
        </tr>
        @endforeach
</table>
@stop