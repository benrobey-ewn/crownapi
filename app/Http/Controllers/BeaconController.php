<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Laravel\Lumen\Routing\Controller as BaseController;

class BeaconController extends BaseController
{

    public function store(Request $request) {
        //this function takes in the SITE ID (from Bluecats) and sets up all of the associated beacons in our DB.
        $site = $request->input('site');
        $client = new Client();
        $result = $client->get('https://api.bluecats.com', [
            'form_params' => [
                'sample-form-data' => 'value'
            ]
        ]);
    }

    public function show() {

    }
}
