<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shop_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $id=Auth::user()->id;
        $shop_id=Shop_user::where('id',$id)->first()->shop_id;//获取商家id
        $orders=Order::where('shop_id',$shop_id)->paginate(5);
        return view('order/index',compact('orders'));

    }

    public function show(Order $order)
    {
        return view('order/show',compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $id=$request->id;
        //dd($id);
        $order=Order::find($id);
        if($request->status=='ing'){
          $order->update(['status'=>4]);
            return redirect()->route('orders.index')->with('发货成功');
        }elseif ($request->status=='last'){
            $order->update(['status'=>-1]);
            return redirect()->route('orders.index')->with('订单取消成功');
        }

    }

    public function orderCount(Request $request)
    {
        $where=[];
        $start_time=strtotime($request->start_time);
        $end_time=strtotime($request->end_time);

        if ($start_time){
            $where[]=['create_at','>',$start_time];
        }
        if($end_time){
            $where[]=['create_at','<',$end_time];
        }
        $count=DB::table('orders')->where($where)->count();
        //dd($start_time);
        $start=date('Y-m-d',$start_time);
        $end=date('Y-m-d',$end_time);

        return view('order/count',compact('start','end','count'));
    }

}
