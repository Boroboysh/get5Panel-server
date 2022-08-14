<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/download/', [\App\Http\Controllers\DownloadController::class, 'download']);

/*Route::middleware(['cors'])->group(function () {

});*/

/*post*/
Route::post('/config/new', function (Request $req){
    $match = $req->all();


    /*$match = (object) [
        "matchid" => "23",
        "num_maps" => 3,
        "spectators" => (object)[
            "players" => [
                "STEAM_1:1:.....",
                "STEAM_1:2:.....",
                "STEAM_1:3:....."
            ]
        ],
        "skip_veto" => 0,
        "veto_first" => "team1",
        "side_type" => "standard",
        "maplist" => [
            "de_dust2",
            "de_inferno",
            "de_mirage",
            "de_nuke",
            "de_overpass",
            "de_train",
        ],
        "players_per_team" => 5,
        "coaches_per_team" => 2,
        "min_players_to_ready" => 1,
        "mit_spectators_to_ready" => 0,
        "team1" => (object) [
            "name" => "Navi",
            "tag" => "Navi",
            "flag" => "RU",
            "logo" => "nv",
            "players" => (object) [
                "STEAM_0:1:52245092" =>"splewis"
            ]
        ],
        "team2" => (object) [
            "name" => "Fnatic",
            "tag" => "fnatic",
            "flag" => "SE",
            "logo" => "fntc",
            "players" => (object) [
                "STEAM_1:1:46796472" => "",
                "STEAM_1:0:78189799" => "",
                "STEAM_1:0:142982" => "",
            ]
        ]
    ];*/
    /*$match = (object)[
        "name" => $name
    ];*/
    $json = json_encode($match);

    $path = public_path('match_cfg/match.json');

    file_put_contents("match.json", $json);

    rename("match.json", $path);

    return response('All okay', 200);
});
