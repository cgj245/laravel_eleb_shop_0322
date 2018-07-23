@extends('default')
@section('contents')
@include('_errors')
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>活动名称</th>
        <th>活动详情</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>操作</th>
    </tr>
    @foreach($actions as $action)
        <tr>
            <td>{{$action->id}}</td>
            <td>{{$action->title}}</td>
            <td>{!!$action->content!!}</td>
            <td>{{$action->start_time}}</td>
            <td>{{$action->end_time}}</td>
            <td>
                <a href="{{route('actions.show',[$action])}}" class="btn btn-primary">查看</a>
            </td>
        </tr>
        @endforeach
</table>
@stop
