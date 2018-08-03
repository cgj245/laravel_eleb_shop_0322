<?php

namespace App\Http\Controllers;

use App\Models\EventShop;
use Illuminate\Http\Request;

class EventShopController extends Controller
{
    public function index()
    {
        $eventShops=EventShop::all();
        return view('eventShop/index',compact('eventShops'));
   }


}
