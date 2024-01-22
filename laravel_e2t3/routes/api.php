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

Route::get('langilearutaTxanda', 'App\http\Controllers\langilea_controller@mostrarTablaTrabajadores');


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



//Kategoriak

Route::get('kategoriaruta', 'App\http\Controllers\kategoria_controller@index');

Route::post('kategoriagorde', 'App\http\Controllers\kategoria_controller@gorde');

Route::put('kategoriaeguneratu/{id}', 'App\Http\Controllers\kategoria_controller@eguneratu');

Route::put('kategoriaezabatu/{id}', 'App\Http\Controllers\kategoria_controller@ezabatu');


//Txandak

Route::get('txandaruta', 'App\http\Controllers\txanda_controller@index');

Route::post('txandagorde', 'App\http\Controllers\txanda_controller@gorde');


//Materiala

Route::get('materialaruta', 'App\http\Controllers\materiala_controller@index');

Route::post('materialagorde', 'App\http\Controllers\materiala_controller@gorde');

Route::put('materialaeguneratu/{id}', 'App\Http\Controllers\materiala_controller@eguneratu');

Route::put('materialaezabatu/{id}', 'App\Http\Controllers\materiala_controller@ezabatu');


// Materiala_erabili

Route::get('materialaerabiliruta', 'App\http\Controllers\materiala_erabili_controller@index');

Route::post('materialaerabiligorde', 'App\http\Controllers\materiala_erabili_controller@gorde');

Route::put('materialaerabilieguneratu/{id}', 'App\Http\Controllers\materiala_erabili_controller@eguneratu');

Route::put('materialaerabiliezabatu/{id}', 'App\Http\Controllers\materiala_erabili_controller@ezabatu');