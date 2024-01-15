<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//añadimos el controlador!!
use App\Http\Controllers\taldea_controller;
use App\Http\Controllers\langilea_controller;
use App\Http\Controllers\ordutegia_controller;

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

//Taldeak

Route::get('taldearuta', 'App\http\Controllers\taldea_controller@index');

Route::get('taldearuta/{kodea}', 'App\http\Controllers\taldea_controller@erakutsi');

Route::post('taldeagorde', 'App\Http\Controllers\taldea_controller@gorde');

Route::put('taldeaeguneratu/{kodea}', 'App\Http\Controllers\taldea_controller@eguneratu');

Route::put('taldeaezabatu/{kodea}', 'App\Http\Controllers\taldea_controller@ezabatu');

//Langileak

Route::get('langilearuta', 'App\http\Controllers\langilea_controller@index');

Route::get('langilearuta/{kodea}', 'App\http\Controllers\langilea_controller@erakutsi');

Route::post('langileagorde', 'App\http\Controllers\langilea_controller@gorde');

Route::put('langileaeguneratu/{id}', 'App\Http\Controllers\langilea_controller@eguneratu');

Route::put('langileaezabatu/{id}', 'App\Http\Controllers\langilea_controller@ezabatu');


//Langileak

Route::get('langilearuta', 'App\http\Controllers\langilea_controller@index');

Route::get('langilearuta/{id}', 'App\http\Controllers\langilea_controller@erakutsi');

Route::post('langileagorde', 'App\http\Controllers\langilea_controller@gorde');

Route::put('langileaeguneratu/{id}', 'App\Http\Controllers\langilea_controller@eguneratu');

Route::put('langileaezabatu/{id}', 'App\Http\Controllers\langilea_controller@ezabatu');

//otra forma de hacerlo:
//Route::get('taldearuta', [taldea_controller::class, 'index']);

//Ordutegiak

Route::get('ordutegiaruta', 'App\http\Controllers\ordutegia_controller@index');

Route::post('ordutegiagorde', 'App\http\Controllers\ordutegia_controller@gorde');

Route::put('ordutegiaeguneratu/{id}', 'App\Http\Controllers\ordutegia_controller@eguneratu');

Route::put('ordutegiaezabatu/{id}', 'App\Http\Controllers\ordutegia_controller@ezabatu');

//así habría que probarlo en la URL, ejemplo:
//http://localhost/Laravel/6_ariketa/public/api/taldearuta