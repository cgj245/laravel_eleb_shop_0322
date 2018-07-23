@extends('default')
@section('contents')
    <table class="table table-bordered">
        <tr>

            <th>商家账号</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>所属商家</th>
            <th>创建时间</th>
            <th>修改时间</th>
        </tr>
            <tr>
                <th>{{Auth::user()->name}}</th>
                <th>{{Auth::user()->email}}</th>
                <th>{{Auth::user()->status==0?"禁用":"启用"}}</th>
                <th>{{Auth::user()->shop?Auth::user()->shop->shop_name:'无'}}</th>
                <th>{{Auth::user()->created_at}}</th>
                <th>{{Auth::user()->updated_at}}</th>
    </tr>
    </table>
    @stop