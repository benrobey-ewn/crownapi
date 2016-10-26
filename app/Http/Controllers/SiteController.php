<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Apis\BluecatsApi;
use Illuminate\Database\Eloquent;
use App\Site;
use App\Beacon;


class SiteController extends BaseController
{
    public function populate() {
        //populate our DB with the references to the sites in bluecats for this app
        $api = new BluecatsApi();
        $sites = json_decode($api->getAllSites(), true);
        foreach($sites['sites'] as $site) {
            if(!Site::where('site_id', $site['id'])->exists()) {
                //insert
                Site::create(array('site_id' => $site['id']));
            }
        };
    }

    public function populateBeaconsForSites() {
        //iterate through our sites and populate the beacons
        //@todo update the beacon if the 'updatedAt' field is > the current created_at / updated_at field in our db
        $api = new BluecatsApi();

        foreach(Site::all() as $site) {
            $beacons = \GuzzleHttp\json_decode($api->getBeaconsForSite($site->site_id), true);
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

    public function store(Request $request) {
        foreach($request->input() as $item) {
            \App\Location::create($item);
        }
    }
}
