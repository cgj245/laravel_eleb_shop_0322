@extends('default')
@section('contents')

    <h3>订单量</h3>
<table class="table table-bordered">
    <tr>
        <td>日期</td>
        <td>{{$start.'--'.$end}}
        </td>
    </tr>
    <tr>
        <td>订单量</td>
        <td>{{$count}}</td>
    </tr>
</table>
<a href="{{route('orders.index')}}"> <button class="btn btn-primary">返回</button></a>
@stop