@extends('default')
@section('contents')
<h3>活动报名列表</h3>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动ID</th>
            <th>商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($eventShops as $eventShop)
            <tr>
                <td>{{$eventShop->id}}</td>
                <td>{{$eventShop->events_id}}</td>
                <td>{{$eventShop->shop_id}}</td>
                <td>

                </td>
            </tr>
            @endforeach
    </table>
@stop
