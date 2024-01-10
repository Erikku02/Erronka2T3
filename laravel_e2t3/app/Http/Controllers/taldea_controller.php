<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taldea;

class taldea_controller extends Controller
{
    public function index(){
        $table = Taldea::all();
        return response()->json($table, 200);
    }

    public function erakutsi($kodea){
        $table = Taldea::where('kodea', $kodea)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $nuevoTalde = array(
            'kodea' => $aux->input('kodea'),
            'izena' => $aux->input('izena'),
            'created_at' => now()
        );

        // Guarda el nuevo registro en la base de datos
        Taldea::insert($nuevoTalde);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoTalde, 201);
    }



    public function eguneratu(Request $aux, $kodea)
    {
        $taldeEguneratuta = Taldea::where('kodea', $kodea)->first();

        // Si no se encuentra el registro, devuelve un error 404
        if (!$taldeEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $taldeEguneratuta->update([
            'kodea' => $aux->input('kodea'),
            'izena' => $aux->input('izena'),
            'updated_at' => now()
        ]);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($taldeEguneratuta, 200);
    }


    public function ezabatu(Request $aux, $kodea)
    {
        $taldeEguneratuta = Taldea::where('kodea', $kodea)->first();

        // Si no se encuentra el registro, devuelve un error 404
        if (!$taldeEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $taldeEguneratuta->update([
            'deleted_at' => now()
        ]);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($taldeEguneratuta, 200);
    }
}
