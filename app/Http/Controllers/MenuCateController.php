<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCate;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MenuCateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $shop_id=Auth::user()->shop_id;
        //dd($shop_id);
        $menuCates=MenuCate::where('shop_id','=',"{$shop_id}")->paginate();
        //$menuCates=DB::table('menu_cates')select("select * from menu_cates where shop_id=?",[$shop_id]);
        //dd($menuCates);
        return view('menu_cate/index',compact('menuCates'));
    }

    public function create()
    {
        $shop=Shop::all();
        return view('menu_cate/create',compact('shop'));
    }

    public function store(Request $request)
    {


        if ($request->is_selected==1){
            DB::table('menu_cates')
                ->where('is_selected', 1)
                ->where('shop_id', Auth::user()->shop_id)
                ->update(['is_selected' =>0]);
        }
//        $shop_id=DB::select("select shop_id from shop_users where id=?",[Auth::user()->id]);
//        //dd($shop_id);
//        $num=DB::select("select count('is_selected') from menu_cates shop_id=?",[$shop_id[0]->shop_id]);
//        dd($num);
        $this->validate($request,[
            'name'=>'required',

        ],['name.required'=>'菜品分类名不能为空']);
        $type_accumulation=uniqid('type_accumulation');

        MenuCate::create(['name'=>$request->name,'description'=>$request->description,'is_selected'=>$request->is_selected,'type_accumulation'=>$type_accumulation,'shop_id'=>$request->shop_id]);
        return redirect()->route('menu_cates.index')->with('success','添加成功');
    }

    public function destroy(MenuCate $menuCate)
    {
//        $aa=Menu::where('category_id',$menuCate->id)->select('goods_name')->get();
//        //dd($aa);
        $id=$menuCate->id;
        $res=DB::select("select goods_name from menus where category_id=?",[$id]);
        //dd($res);
        if($res!=null){
            return back()->with("danger",'该分类下有菜品，不能删除');
        }
        $menuCate->delete();
        return redirect()->route('menu_cates.index')->with('success','删除成功');
    }

    public function edit(MenuCate $menuCate)
    {
        return view('menu_cate/edit',compact('menuCate'));
    }

    public function update(Request $request,MenuCate $menuCate)
    {

        if ($request->is_selected==1){
            DB::table('menu_cates')
                ->where('is_selected', 1)
                ->where('shop_id', Auth::user()->shop_id)
                ->update(['is_selected' =>0]);
        }
        $this->validate($request,[
            'name'=>'required',

        ],['name.required'=>'菜品分类名不能为空']);
        $type_accumulation=uniqid('type_accumulation');

        $menuCate->update(['name'=>$request->name,'description'=>$request->description,'is_selected'=>$request->is_selected,'type_accumulation'=>$type_accumulation,'shop_id'=>$request->shop_id]);
        return redirect()->route('menu_cates.index')->with('success','添加成功');
    }
}
