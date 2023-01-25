<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Reflex\Rcon\Exceptions\NotAuthenticatedException;
use Reflex\Rcon\Exceptions\RconAuthException;
use Reflex\Rcon\Exceptions\RconConnectException;
use Reflex\Rcon\Rcon;

class RconCsGo extends Model
{
    use HasFactory;

    /**
     * @throws RconConnectException
     * @throws RconAuthException
     */

    /**
     * @throws RconConnectException
     * @throws RconAuthException
     * @throws NotAuthenticatedException
     */
    public function startMatch($ip, $port, $password, $filename)
    {
        $rcon = new Rcon($ip, $port, $password);
        $rcon->connect();

        /*http://109.194.163.83:8000*/

        $rcon->exec('get5_loadmatch_url 109.194.163.83:8000/match_cfg/' .$filename .'.json');
    }

    /**
     * @throws RconAuthException
     * @throws RconConnectException
     * @throws NotAuthenticatedException
     */
    public function endMatch ($ip, $port, $password) {
        $rcon = new Rcon($ip, $port, $password);
        $rcon->connect();

        $rcon->exec('get5_endmatch');
    }

    /**
     * @throws RconConnectException
     * @throws RconAuthException
     * @throws NotAuthenticatedException
     */
    public function status($ip, $port, $password)
    {
        $rcon = new Rcon($ip, $port, $password);
        $rcon->connect();

        return $rcon->exec('get5_status');
    }
}
