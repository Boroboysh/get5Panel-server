<?php

namespace App\Http\Controllers;

use App\Models\RconCsGo;
use Illuminate\Http\Request;

class RconController extends Controller
{
    public function getStatus () {
        $server_ip = "217.116.52.85";
        $server_port = 27115;
        $server_pass = "89829817111";

        $response_json =RconCsGo::status($server_ip, $server_port, $server_pass);

        return $response_json;
    }

    public function getCurrentMatch () {
        $server_ip = "217.116.52.85";
        $server_port = 27115;
        $server_pass = "89829817111";

        $status_json = RconCsGo::status($server_ip, $server_port, $server_pass);
        $response = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $status_json), true);;

        return $response['matchid'];
    }

    public function startMatch ($filename) {
        $server_ip = "217.116.52.85";
        $server_port = 27115;
        $server_pass = "89829817111";

        RconCsGo::startMatch($server_ip, $server_port, $server_pass, $filename);

        return 'Okay';
    }

    public function endMatch () {
        $server_ip = "217.116.52.85";
        $server_port = 27115;
        $server_pass = "89829817111";

        RconCsGo::endMatch($server_ip, $server_port, $server_pass);

        return 'Match ended';
    }
}
