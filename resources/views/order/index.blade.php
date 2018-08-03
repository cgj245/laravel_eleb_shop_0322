@extends('default')
@section('contents')
@include('_errors')
    <h3>订单列表</h3>
    <form action="{{route('orderCount')}}" method="get">
            开始时间：<input type="datetime-local" name="start_time">
            结束时间：<input type="datetime-local" name="end_time">
            {{csrf_field()}}
            <input type="submit" value="查询订单"></p>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>订单编号</th>
            <th>用户姓名</th>
            <th>电话</th>
            <th>总金额</th>
            <th>订单状态</th>
            <th>订单创建时间</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->total}}</td>
                <td>
                    {{--状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成,4:已发货)--}}
                    @if($order->status==-1)
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
                    @endif
                </td>
                <td>{{date('Y-m-d H:i:s',$order->create_at)}}</td>
                <td>
                    {{--查看订单--}}
                    <a href="{{route('orders.show',[$order])}}">
                        <button class="btn-info btn-sm">查看订单</button>
                    </a>

                        <a href="{{route('updateStatus',['status'=>'ing','id'=>$order->id])}}">
                            <button class="btn-success btn-sm" >发货</button>
                        </a>
                        <a href="{{route('updateStatus',['status'=>'last','id'=>$order->id])}}">
                            <button class="btn-danger btn-sm" >取消订单</button>
                        </a>


                </td>
            </tr>
        @endforeach
    </table>

    {{$orders->links()}}
@stop
