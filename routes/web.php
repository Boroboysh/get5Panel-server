<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Reflex\Rcon\Rcon;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/config/new', function (Request $req){
    $match = $req->all();

    $json = json_encode($match);

    $path = public_path('match_cfg/' .$req->input("matchid") .".json");

    file_put_contents($req->input("matchid") .".json", $json);

    rename($req->input("matchid") .".json", $path);

    return response('All okay', 200);
});

Route::get('/rcon/status', function () {
    $server_ip = "217.116.52.85";
    $server_port = 27115;
    $server_pass = "89829817111";

    $rcon =  new Rcon($server_ip, $server_port, $server_pass);
    $rcon->connect();

    $rcon->exec('bot_add_ct');
    $response = $rcon->exec('status');

    return compact('response');
});
