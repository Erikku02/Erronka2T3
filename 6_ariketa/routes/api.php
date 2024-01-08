<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//añadimos el controlador!!
use App\Http\Controllers\beharrak_controller;

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

Route::get('beharrakruta', 'App\http\Controllers\beharrak_controller@index');

Route::get('beharrakruta/{id}', 'App\http\Controllers\beharrak_controller@erakutsi');

Route::post('beharrakgorde', 'App\Http\Controllers\beharrak_controller@gorde');

Route::put('beharrakeguneratu/{id}', 'App\Http\Controllers\beharrak_controller@eguneratu');

Route::delete('beharrakezabatu/{id}', 'App\Http\Controllers\beharrak_controller@ezabatu');

//otra forma de hacerlo:
//Route::get('beharrakruta', [beharrak_controller::class, 'index']);


//así habría que probarlo en la URL:
//http://localhost/Laravel/6_ariketa_Laravel_APIRestful/public/api/beharrakruta