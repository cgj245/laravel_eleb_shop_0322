<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCate;
use App\Models\OrderGood;
use App\Models\Shop;
use App\Models\Shop_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request)
    {
        $shop_id=Auth::user()->shop_id;
        $keyword=$request->keyword;
        $pricemin=$request->pricemin;
        $pricemax=$request->pricemax;
       $where[]=['shop_id','=',"{$shop_id}"];
       $data=[];

        $cates=MenuCate::where('shop_id',$shop_id)->get();
//        foreach ($cates as &$cate){
//            $where[]=['category_id',$cate->id];
//        }

        if ($keyword!=null){
            $where[]=['goods_name','like','%'.$keyword.'%'];
           $data['keyword']=$keyword;
        }
         if ($pricemin!=null){
                $where[]=['goods_price','>=',$pricemin];
             $data['pricemin']=$pricemin;
          }
       if ($pricemax){
                $where[]=['goods_price','<=',$pricemax];
           $data['pricemax']=$pricemax;
               }

        $menus=Menu::where($where)
            ->paginate(3);
        return view('menu/index',compact('menus','data','cates'));
    }
    public function create()
    {
        $shop=Shop::all();
        $shop_id=Auth::user()->shop_id;
        $menuCate=MenuCate::where('shop_id','=',"{$shop_id}")->paginate();
        //dd($menuCate);
        return view('menu/create',compact('shop','menuCate'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'category_id'=>'required',
        'goods_price'=>'required',
        'goods_img'=>'required',

        ],[
            'goods_name.required'=>'菜品名不能为空',
            'category_id.required'=>'菜品分类名不能为空',
            'goods_price.required'=>'菜品价格不能为空',
            'goods_img.required'=>'菜品图片不能为空',
        ]);
        $month_sales=0;
        $rating_count=0;
        $tips=0;
        $satisfy_count=0;
        $satisfy_rate=0;
        $rating=rand(1,5);
//        $storage=Storage::disk('oss');
//        $fileName=$storage->putFile('menu',$request->goods_img);
        $shop_id=Auth::user()->shop_id;
//       $file=$request->goods_img;
//        $fileName=$file->store('public/goods_img');goods_img
        Menu::create(['goods_name'=>$request->goods_name,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'shop_id'=>$shop_id,
            'description'=>$request->description,
            'goods_img'=>$request->goods_img,
            'month_sales'=>$month_sales,
            'rating_count'=>$rating_count,
            'tips'=>$tips,
            'satisfy_count'=>$satisfy_count,
            'satisfy_rate'=>$satisfy_rate,
            'rating'=>$rating,
        ]);
        return redirect()->route('menus.index')->with('success','添加成功');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除成功');
    }

    public function edit(Menu $menu)
    {
        $shop_id=Auth::user()->shop_id;
        $menuCate=MenuCate::where('shop_id','=',"{$shop_id}")->paginate();
        return view('menu/edit',compact('menu','menuCate'));
    }

    public function update(Request $request,Menu $menu)
    {


        $month_sales=0;
        $rating_count=0;
        $tips=0;
        $satisfy_count=0;
        $satisfy_rate=0;
        $rating=0;
        $shop_id=Auth::user()->shop_id;

        if(!empty($request->goods_img)){

//            $storage=Storage::disk('oss');
//            $fileName=$storage->putFile('menu',$request->goods_img);
            $menu->update(['goods_name'=>$request->goods_name,
                'category_id'=>$request->category_id,
                'goods_price'=>$request->goods_price,
                'shop_id'=>$shop_id,
                'description'=>$request->description,
                'goods_img'=>$request->goods_img,
                'month_sales'=>$month_sales,
                'rating_count'=>$rating_count,
                'tips'=>$tips,
                'satisfy_count'=>$satisfy_count,
                'satisfy_rate'=>$satisfy_rate,
                'rating'=>$rating,
            ]);
        }else{
            $menu->update(['goods_name'=>$request->goods_name,
                'category_id'=>$request->category_id,
                'goods_price'=>$request->goods_price,
                'shop_id'=>$shop_id,
                'description'=>$request->description,
                'month_sales'=>$month_sales,
                'rating_count'=>$rating_count,
                'tips'=>$tips,
                'satisfy_count'=>$satisfy_count,
                'satisfy_rate'=>$satisfy_rate,
                'rating'=>$rating,
            ]);
        }

        return redirect()->route('menus.index')->with('success','修改成功');
    }

    public function menuCount(Request $request)
    {

        $where='';
        $start_time=strtotime($request->start_time);
        $end_time=strtotime($request->end_time);
        if ($start_time){
            $where=" and created_at > $start_time";
        }
        if($end_time){
            $where=" and created_at < $end_time";
        }
        $id=Auth::user()->id;
        $shop_id=Shop_user::where('id',$id)->first()->shop_id;//获取商家id
        $menus=Menu::where('shop_id',$shop_id)->get();

        $orders=DB::table('orders')->where('shop_id',$shop_id)->get();//获取该商家所有订单
        foreach ($orders as $order){
            $order_ids[]=$order->id;//获取订单id;
        }
        $str_id=implode(',',$order_ids);
        $goods=DB::select("select goods_id,sum(amount) as amount from order_goods where order_id in ($str_id) $where group by goods_id");

        foreach($menus as $menu){
            foreach ($goods as $good){
                if($menu->id==$good->goods_id){
                    $menu['amount']=$good->amount;
                }
            }

        }


        return view('menu/count',compact('menus'));
    }

}
