@extends('default')
@section('contents')
<h1>活动详情</h1>
   <p> 活动名称：{{$action->title}}</p>
   <p> 活动详情：{!!$action->content!!}</p>
@stop

