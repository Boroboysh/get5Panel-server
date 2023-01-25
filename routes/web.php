<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/configList', [\App\Http\Controllers\ConfigController::class, 'getConfigList']);

Route::get('/configList/{cfg}', [\App\Http\Controllers\ConfigController::class, 'getCurrentConfig']);

Route::post('/config/new', [\App\Http\Controllers\ConfigController::class, 'createConfig']);

Route::get('/rcon/status', [\App\Http\Controllers\RconController::class, 'getStatus']);

Route::get('/rcon/currentMatch', [\App\Http\Controllers\RconController::class, 'getCurrentMatch']);

Route::get('/rcon/start/{filename}', [\App\Http\Controllers\RconController::class, 'startMatch']);

Route::get('/rcon/end', [\App\Http\Controllers\RconController::class, 'endMatch']);

Route::get('/login', [\App\Http\Controllers\SteamAuthController::class, 'login']);


