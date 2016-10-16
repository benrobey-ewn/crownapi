<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    try {
        $results = DB::select("SELECT * FROM members");
    }
    catch(Exception $exception) {
        print_r($exception->getMessage());
    }
    return $app->version();
});
