<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{


    public function create()
    {
        return view('session/login');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误'
        ]);
        if ($request->password!=$request->repassword){
            return back()->with('danger','确认密码错误');
        }
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password
        ],$request->remember)){
            //账号状态
            $status1=DB::table('shop_users')->where('name',$request->name)->value('status');
            //dd($status1);
            //商家信息状态
            $status2=DB::select("select shops.status from shops JOIN shop_users on shops.id=shop_users.shop_id where name=?",[$request->name]);
            //dd($status2);
            if ($status1!=1){
                return back()->with("danger","账号被禁用");
            }
            if ($status2[0]->status!=1){
               return back()->with("danger","商家还在审核中，账号暂时不能用");
            }
            return redirect()->route('shops.index')->with("success","登录成功");
        }else{
            return redirect()->route('login')->with("danger","登录失败")->withInput();
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with("success",'注销成功');
    }
}
