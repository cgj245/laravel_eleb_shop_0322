@extends('default')
@section('contents')
    <h3>订单详情</h3>
    <table class="table table-bordered">
        <tr>
            <td>ID</td>
            <td>{{$order->id}}</td>
        </tr>
        <tr>
            <td>订单编号</td>
            <td>{{$order->sn}}</td>
        </tr>
        <tr>
            <td>用户姓名</td>
            <td>{{$order->name}}</td>
        </tr>
        <tr>
            <td>电话</td>
            <td>{{$order->tel}}</td>
        </tr>
        <tr>
            <td>详细地址</td>
            <td>{{$order->province.$order->city.$order->county.$order->address}}</td>
        </tr>
        <tr>
            <td>总金额</td>
            <td>{{$order->total}}</td>
        </tr>
        <tr>
            <td>订单状态</td>
            <td>@if($order->status==-1)
                    已取消
                @elseif($order->status==0)
                    待支付
                @elseif($order->status==1)
                    待发货
                @elseif($order->status==2)
                    待确认
                @elseif($order->status==3)
                    完成
                @elseif($order->status==4)
                    已发货
                @endif</td>
        </tr>
        <tr>
            <td>订单创建时间</td>
            <td>{{date('Y-m-d H:i',$order->create_at)}}</td>
        </tr>
    </table>
@stop
