<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



use Laravel\Lumen\Routing\Controller as BaseController;

class LocationController extends BaseController
{
    public function store(Request $request) {
        foreach($request->input() as $item) {
            \App\Location::create($item);
        }
    }
}
