<?php

namespace App\Http\Controllers;

use App\Models\Shop_user;
use Illuminate\Http\Request;

class Shop_userController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        return view('shop_user/index');
    }
    public function edit(Shop_user $shop_user)
    {
        //return '123';
        return view('shop_user/edit',compact('shop_user'));
   }
    public function update(Request $request,Shop_user $shop_user)
    {
        //dd($request->all());
        $this->validate($request,[
            'password'=>'required|confirmed',
        ],[
            'password.require'=>'密码不能为空',
            'password.confirmed'=>'两次密码不一致',
        ]);
        if ($request->oldpassword!=null){
            if (!Hash::check($request->oldpassword, $shop_user->password)) {
                return back()->with()('danger',"旧密码错误");
            }

        }
        $password=bcrypt($request->password);
        $shop_user->update(['email'=>$request->email,'password'=>$password,]);
        session()->flash('success',"修改成功");
        return redirect()->route('shop_users.index');
    }
}
