<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{

    public function index()
    {
        //$time=date('Y-m-d H:i:s',time());
        //dd($time);
        $actions=Action::paginate();
        return view('action/index',compact('actions'));
    }


    public function show(Action $action)
    {
        return view('action/show',compact('action'));
    }
}
