<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class BeaconEventController extends BaseController
{
    public function store(Request $request) {
        foreach($request->input() as $item) {
            \App\BeaconEvent::create($item);
        }
    }
}
