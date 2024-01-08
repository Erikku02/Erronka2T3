<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//añadimos el controlador!!
use App\Http\Controllers\taldea_controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//beharren rutak kudeatu

Route::get('taldearuta', 'App\http\Controllers\taldea_controller@index');

Route::get('taldearuta/{kodea}', 'App\http\Controllers\taldea_controller@erakutsi');

Route::post('taldeagorde', 'App\Http\Controllers\taldea_controller@gorde');

Route::put('taldeaeguneratu/{kodea}', 'App\Http\Controllers\taldea_controller@eguneratu');

Route::put('taldeaezabatu/{kodea}', 'App\Http\Controllers\taldea_controller@ezabatu');

//otra forma de hacerlo:
//Route::get('taldearuta', [taldea_controller::class, 'index']);


//así habría que probarlo en la URL, ejemplo:
//http://localhost/Laravel/6_ariketa/public/api/taldearuta