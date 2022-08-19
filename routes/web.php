<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Reflex\Rcon\Rcon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/configList', function () {
    $dir = opendir('./../public/match_cfg');
    $files = [];

    $count = 0;

    while($file = readdir($dir)){
        if($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)){
            continue;
        }
        $count++;
        array_push($files, $file);
    }

    return $files;
});

Route::get('/configList/{cfg}', function ($filename){
    return 'Имя файла:' .$filename;
});

Route::post('/config/new', function (Request $req) {
    $match = $req->all();
    $server_ip = "217.116.52.85";
    $server_port = 27115;
    $server_pass = "89829817111";

    $json = json_encode($match);

    $path = public_path('match_cfg/' . $req->input("matchid") . ".json");

    file_put_contents($req->input("matchid") . ".json", $json);

    rename($req->input("matchid") . ".json", $path);

    (new App\Models\RconCsGo)->startMatch($server_ip, $server_port, $server_pass, $req->input('matchid'));


    return response('All okay', 200);
});

Route::get('/rcon/status', function () {
    $server_ip = "217.116.52.85";
    $server_port = 27115;
    $server_pass = "89829817111";

    $res = (new App\Models\RconCsGo)->status($server_ip, $server_port, $server_pass);

    return $res;
});

Route::get('/rcon/start/{filename}', function ($filename) {
    $server_ip = "217.116.52.85";
    $server_port = 27115;
    $server_pass = "89829817111";

    (new App\Models\RconCsGo)->startMatch($server_ip, $server_port, $server_pass, $filename);

    return 'Okay';
});

Route::get('/rcon/end', function () {
    $server_ip = "217.116.52.85";
    $server_port = 27115;
    $server_pass = "89829817111";

    (new App\Models\RconCsGo)->endMatch($server_ip, $server_port, $server_pass);

    return 'Match ended';
});
