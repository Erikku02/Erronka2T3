<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordutegia;

class ordutegia_controller extends Controller
{
    //
    public function index(){
        $table = Ordutegia::all();
        return response()->json($table, 200);
    }

    public function gorde(Request $aux)
    {
        $nuevoHorario = array(
            'kodea' => $aux->input('kodea'),
            'eguna' => $aux->input('eguna'),
            'hasiera_data' => $aux->input('hasiera_data'),
            'amaiera_data' => $aux->input('amaiera_data'),
            'hasiera_ordua' => $aux->input('hasiera_data'),
            'amaiera_ordua' => $aux->input('hasiera_data'),
            'created_at' => now()

        );

        // Guarda el nuevo registro en la base de datos
        Ordutegia::insert($nuevoHorario);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoHorario, 201);
    }

}
