<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;

use Laravel\Lumen\Routing\Controller as BaseController;

class EventController extends BaseController
{
    public function store(Request $request) {
        $event = new Event();

        $event->member_id = $request->member_id;
        $event->beacon_uuid = $request->beacon_uuid;
        $event->beacon_major = $request->beacon_major;
        $event->beacon_minor = $request->beacon_minor;

        $event->save();
    }
}
