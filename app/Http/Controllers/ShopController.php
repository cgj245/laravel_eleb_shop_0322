<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_category;
use App\Models\Shop_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ShopController extends Controller
{
    public function index()
    {
        $shop=Shop::all();
        return view('shop/index',compact('shop'));
    }

    public function create()
    {
        $shop_categorys=Shop_category::all();
        return view('shop/create',compact('shop_categorys'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_img'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'name'=>'required',
            'email'=>'required|unique:shop_users',
            'password'=>'required',
            'captcha'=>'required|captcha',

        ],[
            'shop_category_id.require'=>'分类名不能为空',
            'shop_name.require'=>'商品名不能为空',
            'shop_img.require'=>'店铺图片不能为空',
            'start_send.require'=>'起送金额不能为空',
            'send_cost.require'=>'配送费不能为空',
           'name.require'=>'名称不能为空',
            'email.require'=>'邮箱不能为空',
            'email.unique'=>'邮箱已存在',
            'password.require'=>'密码不能为空',
            'captcha.require'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误',
        ]);

        if ($request->password!=$request->repassword){
            return back()->with("danger","确认密码错误");
        }
        $status1=0;//店铺注册审核状态0表示待审核
        $status2=1;//商家账号状态1表示是启用
        $shop_rating=0;
//        $file=$request->shop_img;
//        $fileName=$file->store('public/shopimg');
        $storage=Storage::disk('oss');
//            $fileName=$storage->putFile('menu',$request->goods_img);
        //$img=Storage::url($fileName);

        DB::beginTransaction();

        try{
            $shopinfo= Shop::create([
                'shop_name'=>$request->shop_name,
                'shop_img'=>$request->shop_img,
                'shop_category_id'=>$request->shop_category_id,
                'shop_rating'=>$shop_rating,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'brand'=>$request->brand,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'fengniao'=>$request->fengniao,
                'on_time'=>$request->on_time,
                'status'=>$status1
            ]);
            $password=bcrypt($request->password);
            Shop_user::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$password,
                'status'=>$status2,
                'shop_id'=>$shopinfo->id

            ]);

            DB::commit();
            session()->flash('success',"注册成功");
            return redirect()->route('shops.index');
        }catch(\Exception $e){
           DB::rollBack();
           return back()->with("danger",'注册失败');
        }
    }
}
