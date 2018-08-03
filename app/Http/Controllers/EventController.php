<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventShop;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        //$events=Event::where('is_prize',0)->get();
        $events = Event::all();
        return view('event/index', compact('events'));
    }

    public function updatestatus(Request $request, Event $event)
    {
        //dd($request->id);
        $events_id = $request->id;
        $shop_id = $request->shop_id;
        EventShop::create([
            'events_id' => $events_id,
            'shop_id' => $shop_id,
        ]);


        return redirect()->route('events.index')->with('success', '报名成功');

    }
}
