<?php

namespace App\Http\Controllers;

use App\Models\RconCsGo;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getConfigList () {
        $dir = opendir('./../public/match_cfg');
        $files = [];

        $count = 0;

        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)) {
                continue;
            }
            $count++;
            array_push($files, $file);
        }

        return $files;
    }

    public function getCurrentConfig ($filename) {
        return 'Имя файла:' . $filename;
    }

    public function createConfig (Request $req) {
        $match = $req->all();
        $server_ip = "217.116.52.85";
        $server_port = 27115;
        $server_pass = "89829817111";

        $json = json_encode($match);
        $path = public_path('match_cfg/' . $req->input("matchid") . ".json");

        file_put_contents($req->input("matchid") . ".json", $json);
        rename($req->input("matchid") . ".json", $path);

        RconCsGo::startMatch($server_ip, $server_port, $server_pass, $req->input('matchid'));

        return response('Ok', 200);
    }
}
