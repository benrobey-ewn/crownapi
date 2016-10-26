<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apis\BluecatsApi;
use App\Beacon;

use Laravel\Lumen\Routing\Controller as BaseController;

class BeaconController extends BaseController
{

    public function store(Request $request) {
        //this function takes in the SITE ID (from Bluecats) and sets up all of the associated beacons in our DB.
        $site = $request->input('site');
    }

    public function show() {
        $api = new BluecatsApi();
        $response = \GuzzleHttp\json_decode($api->getAllSites());
    }

    public function updateBeacons() {
        //iterate through our sites and populate the beacons
        //@todo update the beacon if the 'updatedAt' field is > the current created_at / updated_at field in our db
        $api = new BluecatsApi();

        $beacons = \GuzzleHttp\json_decode($api->getAllBeacons(), true);
        foreach($beacons['beacons'] as $beacon) {
            if(!Beacon::where('beacon_id', $beacon['id'])->exists()) {
                Beacon::create(
                    [
                        'beacon_uuid'   => $beacon['proximityUUID'],
                        'beacon_id'     => $beacon['id'],
                        'beacon_major'  => $beacon['major'],
                        'beacon_minor'  => $beacon['minor']
                    ]
                );
            }
        }
    }
}
