@extends('default')
@section('contents')
    <h3>抽奖活动列表</h3>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{!! $event->content !!}</td>
                <td>{{date('Y-m-d H:i',$event->signup_start)}}</td>
                <td>{{date('Y-m-d H:i',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==0?'未开奖':'已开奖'}}</td>
                <td>
@if(\App\Models\EventShop::where([['events_id',$event->id],['shop_id',auth()->user()->shop_id]])->count()==0)
                    <a href="{{route('updatestatus',['id'=>$event->id,'shop_id'=>auth()->user()->shop_id])}}" class="btn btn-primary">报名</a>
@else
                    <a href="{{route('updatestatus',['id'=>$event->id,'shop_id'=>auth()->user()->shop_id])}}" class="btn btn-primary">已报名</a>
@endif
                </td>
            </tr>0
        @endforeach
    </table>
@stop
