<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//añadimos el controlador!!
use App\Http\Controllers\taldea_controller;
use App\Http\Controllers\langilea_controller;
use App\Http\Controllers\ordutegia_controller;
use App\Http\Controllers\kategoria_controller;
use App\Http\Controllers\txanda_controller;
use App\Http\Controllers\materiala_controller;
use App\Http\Controllers\materiala_erabili_controller;
use App\Http\Controllers\produktua_controller;
use App\Http\Controllers\produktu_mugimendua_controller;
use App\Http\Controllers\tratamendua_controller;
use App\Http\Controllers\bezero_fitxa_controller;
use App\Http\Controllers\kolore_historiala_controller;
use App\Http\Controllers\hitzordua_controller;
use App\Http\Controllers\ticket_lerroa_controller;
use App\Http\Controllers\erabiltzailea_controller;


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

// Route::get('taldearuta', 'App\http\Controllers\taldeac_controller@index');
Route::get('taldearuta', [taldea_controller::class, 'index']);

// Route::get('taldearuta/{kodea}', 'App\http\Controllers\taldeac_controller@erakutsi');

Route::get('taldearuta/{kodea}', [taldea_controller::class, 'erakutsi']);

// Route::post('taldeagorde', 'App\Http\Controllers\taldeac_controller@gorde');

Route::post('taldeagorde', [taldea_controller::class, 'gorde']);

// Route::put('taldeaeguneratu/{kodea}', 'App\Http\Controllers\taldeac_controller@eguneratu');

Route::put('taldeaeguneratu/{kodea}', [taldea_controller::class, 'eguneratu']);

// Route::put('taldeaezabatu/{kodea}', 'App\Http\Controllers\taldeac_controller@ezabatu');

Route::put('taldeaezabatu/{kodea}', [taldea_controller::class, 'ezabatu']);

Route::get('taldeaComprobarLangileak/{kodea}', [taldea_controller::class, 'comprobarLangileak']);


//Langileak

// Route::get('langilearuta', 'App\http\Controllers\langilea_controller@index');

Route::get('langilearuta', [langilea_controller::class, 'index']);

// Route::get('langilearuta/{kodea}', 'App\http\Controllers\langilea_controller@erakutsi');

Route::get('langilearuta/{kodea}', [langilea_controller::class, 'erakutsi']);

// Route::get('langilearutaTxanda', 'App\http\Controllers\langilea_controller@mostrarTablaTrabajadores');

Route::get('langilearutaTxanda', [langilea_controller::class, 'mostrarTablaTrabajadores']);

// Route::post('langileagorde', 'App\http\Controllers\langilea_controller@gorde');

Route::post('langileagorde', [langilea_controller::class, 'gorde']);

// Route::put('langileaeguneratu/{id}', 'App\Http\Controllers\langilea_controller@eguneratu');

Route::put('langileaeguneratu/{id}', [langilea_controller::class, 'eguneratu']);

// Route::put('langileaezabatu/{id}', 'App\Http\Controllers\langilea_controller@ezabatu');

Route::put('langileaezabatu/{id}', [langilea_controller::class, 'ezabatu']);

//otra forma de hacerlo:
//Route::get('taldearuta', [taldea_controller::class, 'index']);

//Ordutegiak

// Route::get('ordutegiaruta', 'App\http\Controllers\ordutegia_controller@index');

Route::get('ordutegiaruta', [ordutegia_controller::class, 'index']);

// Route::post('ordutegiagorde', 'App\http\Controllers\ordutegia_controller@gorde');

Route::post('ordutegiagorde', [ordutegia_controller::class, 'gorde']);

// Route::put('ordutegiaeguneratu/{id}', 'App\Http\Controllers\ordutegia_controller@eguneratu');

Route::put('ordutegiaeguneratu/{id}', [ordutegia_controller::class, 'eguneratu']);

// Route::put('ordutegiaezabatu/{id}', 'App\Http\Controllers\ordutegia_controller@ezabatu');

Route::put('ordutegiaezabatu/{id}', [ordutegia_controller::class, 'ezabatu']);

//Kategoriak

// Route::get('kategoriaruta', 'App\http\Controllers\kategoria_controller@index');

Route::get('kategoriaruta', [kategoria_controller::class, 'index']);

// Route::post('kategoriagorde', 'App\http\Controllers\kategoria_controller@gorde');

Route::post('kategoriagorde', [kategoria_controller::class, 'gorde']);

// Route::put('kategoriaeguneratu/{id}', 'App\Http\Controllers\kategoria_controller@eguneratu');

Route::put('kategoriaeguneratu/{id}', [kategoria_controller::class, 'eguneratu']);

// Route::put('kategoriaezabatu/{id}', 'App\Http\Controllers\kategoria_controller@ezabatu');

Route::put('kategoriaezabatu/{id}', [kategoria_controller::class, 'ezabatu']);

//así habría que probarlo en la URL, ejemplo:
//http://localhost/Laravel/6_ariketa/public/api/taldearuta

//Txandak

// Route::get('txandaruta', 'App\http\Controllers\txanda_controller@index');

Route::get('txandaruta', [txanda_controller::class, 'index']);

// Route::get('txandaruta/{kodea}', 'App\http\Controllers\txanda_controller@erakutsi');

Route::get('txandaruta/{kodea}', [txanda_controller::class, 'erakutsi']);

// Route::post('txandagorde', 'App\http\Controllers\txanda_controller@gorde');

Route::post('txandagorde', [txanda_controller::class, 'gorde']);

// Route::get('txandaMostradorea/{kodea}', 'App\http\Controllers\txanda_controller@azkenMostradorea');

Route::get('txandaMostradorea/{kodea}', [txanda_controller::class, 'azkenMostradorea']);

// Route::get('txandaGarbiketa/{kodea}', 'App\http\Controllers\txanda_controller@azkenBiGarbiketa');

Route::get('txandaGarbiketa/{kodea}', [txanda_controller::class, 'azkenBiGarbiketa']);





//Materiala

// Route::get('materialaruta', 'App\http\Controllers\materiala_controller@index');

Route::get('materialaruta', [materiala_controller::class, 'index']);

// Route::post('materialagorde', 'App\http\Controllers\materiala_controller@gorde');

Route::post('materialagorde', [materiala_controller::class, 'gorde']);

// Route::put('materialaeguneratu/{id}', 'App\Http\Controllers\materiala_controller@eguneratu');

Route::put('materialaeguneratu/{id}', [materiala_controller::class, 'eguneratu']);

// Route::put('materialaezabatu/{id}', 'App\Http\Controllers\materiala_controller@ezabatu');

Route::put('materialaezabatu/{id}', [materiala_controller::class, 'ezabatu']);

// Materiala_erabili

// Route::get('materialaerabiliruta', 'App\http\Controllers\materiala_erabili_controller@index');

Route::get('materialaerabiliruta', [materiala_erabili_controller::class, 'index']);

// Route::post('materialaerabiligorde', 'App\http\Controllers\materiala_erabili_controller@gorde');

Route::post('materialaerabiligorde', [materiala_erabili_controller::class, 'gorde']);

// Route::put('materialaerabilieguneratu/{id}', 'App\Http\Controllers\materiala_erabili_controller@eguneratu');

Route::put('materialaerabilieguneratu/{id}', [materiala_erabili_controller::class, 'eguneratu']);

// Route::put('materialaerabiliezabatu/{id}', 'App\Http\Controllers\materiala_erabili_controller@ezabatu');

Route::put('materialaerabiliezabatu/{id}', [materiala_erabili_controller::class, 'ezabatu']);

//Produktuak

// Route::get('produktuaruta', 'App\http\Controllers\produktua_controller@index');

Route::get('produktuaruta', [produktua_controller::class, 'index']);

// Route::get('markaruta', 'App\http\Controllers\produktua_controller@ateraMarka');

Route::get('markaruta', [produktua_controller::class, 'ateraMarka']);

// Route::post('produktuagorde', 'App\http\Controllers\produktua_controller@gorde');

Route::post('produktuagorde', [produktua_controller::class, 'gorde']);

// Route::put('produktuaeguneratu/{id}', 'App\Http\Controllers\produktua_controller@eguneratu');

Route::put('produktuaeguneratu/{id}', [produktua_controller::class, 'eguneratu']);

// Route::put('produktuaezabatu/{id}', 'App\Http\Controllers\produktua_controller@ezabatu');

Route::put('produktuaezabatu/{id}', [produktua_controller::class, 'ezabatu']);


//Produktu-Mugimenduak

// Route::get('produktumugimenduaruta', 'App\http\Controllers\produktu_mugimendua_controller@index');

Route::get('produktumugimenduaruta', [produktu_mugimendua_controller::class, 'index']);

// Route::get('markaruta', 'App\http\Controllers\produktua_controller@ateraMarka');

// Route::post('produktumugimenduagorde', 'App\http\Controllers\produktu_mugimendua_controller@gorde');

Route::post('produktumugimenduagorde', [produktu_mugimendua_controller::class, 'gorde']);

// Route::put('produktuaeguneratu/{id}', 'App\Http\Controllers\produktua_controller@eguneratu');

// Route::put('produktuaezabatu/{id}', 'App\Http\Controllers\produktua_controller@ezabatu');


//Tratamenduak

// Route::get('tratamenduaruta', 'App\http\Controllers\tratamendua_controller@index');

Route::get('tratamenduaruta', [tratamendua_controller::class, 'index']);

// Route::post('tratamenduagorde', 'App\http\Controllers\tratamendua_controller@gorde');

Route::post('tratamenduagorde', [tratamendua_controller::class, 'gorde']);

// Route::put('tratamenduaeguneratu/{id}', 'App\Http\Controllers\tratamendua_controller@eguneratu');

Route::put('tratamenduaeguneratu/{id}', [tratamendua_controller::class, 'eguneratu']);

// Route::put('tratamenduaezabatu/{id}', 'App\Http\Controllers\tratamendua_controller@ezabatu');

Route::put('tratamenduaezabatu/{id}', [tratamendua_controller::class, 'ezabatu']);

Route::get('/tratamenduastats/{talde}', [tratamendua_controller::class, 'langileTratamenduStats']);


//Bezero_fitxak

// Route::get('bezero_fixaruta', 'App\http\Controllers\bezero_fitxa_controller@index');

Route::get('bezero_fixaruta', [bezero_fitxa_controller::class, 'index']);

// Route::post('bezero_fixagorde', 'App\http\Controllers\bezero_fitxa_controller@gorde');

Route::post('bezero_fixagorde', [bezero_fitxa_controller::class, 'gorde']);

// Route::put('bezero_fixaeguneratu/{id}', 'App\Http\Controllers\bezero_fitxa_controller@eguneratu');

Route::put('bezero_fixaeguneratu/{id}', [bezero_fitxa_controller::class, 'eguneratu']);

// Route::put('bezero_fixaezabatu/{id}', 'App\Http\Controllers\bezero_fitxa_controller@ezabatu');

Route::put('bezero_fixaezabatu/{id}', [bezero_fitxa_controller::class, 'ezabatu']);


//Kolore_historiala

// Route::get('kolore_histruta', 'App\http\Controllers\kolore_historiala_controller@index');

Route::get('kolore_histruta', [kolore_historiala_controller::class, 'index']);

// Route::post('kolore_histgorde', 'App\http\Controllers\kolore_historiala_controller@gorde');

Route::post('kolore_histgorde', [kolore_historiala_controller::class, 'gorde']);

// Route::put('kolore_histeguneratu/{id}', 'App\Http\Controllers\kolore_historiala_controller@eguneratu');

Route::put('kolore_histeguneratu/{id}', [kolore_historiala_controller::class, 'eguneratu']);

// Route::put('kolore_histezabatu/{id}', 'App\Http\Controllers\kolore_historiala_controller@ezabatu');

Route::put('kolore_histezabatu/{id}', [kolore_historiala_controller::class, 'ezabatu']);


//así habría que probarlo en la URL, ejemplo:
//http://localhost/Laravel/6_ariketa/public/api/taldearuta


// Hitzordua

// Route::get('hitzorduaruta', 'App\http\Controllers\hitzordua_controller@index');

Route::get('hitzorduaruta', [hitzordua_controller::class, 'index']);

// Route::post('hitzorduagorde', 'App\http\Controllers\hitzordua_controller@gorde');

Route::post('hitzorduagorde', [hitzordua_controller::class, 'gorde']);

// Route::put('hitzorduaeguneratu/{id}', 'App\Http\Controllers\hitzordua_controller@eguneratu');

Route::put('hitzorduaeguneratu/{id}', [hitzordua_controller::class, 'eguneratu']);

// Route::put('hitzorduaezabatu/{id}', 'App\Http\Controllers\hitzordua_controller@ezabatu');

Route::put('hitzorduaezabatu/{id}', [hitzordua_controller::class, 'ezabatu']);


//Materiala erabili

// Route::get('materialaerabiliruta', 'App\http\Controllers\materiala_erabili_controller@index');

Route::get('materialaerabiliruta', [materiala_erabili_controller::class, 'index']);

// Route::post('materialaerabiligorde', 'App\http\Controllers\materiala_erabili_controller@gorde');

Route::post('materialaerabiligorde', [materiala_erabili_controller::class, 'gorde']);

// Route::put('materialaerabiliezabatu/{id}', 'App\Http\Controllers\materiala_erabili_controller@ezabatu');

Route::put('materialaerabiliezabatu/{id}', [materiala_erabili_controller::class, 'ezabatu']);


// Ticket_lerroa 

// Route::get('ticketlerroaruta', 'App\http\Controllers\ticket_lerroa_controller@index');

Route::get('ticketlerroaruta', [ticket_lerroa_controller::class, 'index']);

// Route::post('ticketlerroagorde', 'App\http\Controllers\ticket_lerroa_controller@gorde');

Route::post('ticketlerroagorde', [ticket_lerroa_controller::class, 'gorde']);



// Erabiltzailea

Route::get('erabiltzailearuta', [erabiltzailea_controller::class, 'index']);

Route::get('erabiltzailearuta/{username}', [erabiltzailea_controller::class, 'erakutsi']);

Route::post('erabiltzaileagorde', [erabiltzailea_controller::class, 'gorde']);

Route::put('erabiltzaileaeguneratu/{username}', [erabiltzailea_controller::class, 'eguneratu']);

Route::put('erabiltzaileaezabatu/{username}', [erabiltzailea_controller::class, 'ezabatu']);

Route::post('login', [erabiltzailea_controller::class, 'login']);

