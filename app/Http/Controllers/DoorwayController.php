<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



use Laravel\Lumen\Routing\Controller as BaseController;

class DoorwayController extends BaseController
{
    public function store(Request $request) {
        foreach($request->input() as $item) {
            \App\Doorway::create($item);
        }
    }
}
