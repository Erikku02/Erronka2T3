<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taldea;

class taldea_controller extends Controller
{
    public function index()
    {
        $table = Taldea::all();
        return response()->json($table, 200);
    }

    public function erakutsi($kodea)
    {
        $table = Taldea::where('kodea', $kodea)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoTalde = ["kodea" => $datos["kodea"], "izena" => $datos["izena"], "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Taldea::insert($nuevoTalde);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoTalde, 201);
    }

    public function eguneratu(Request $aux, $kodea)
    {
        $datos = $aux->all;

        // Verifica si se proporciona un nuevo nombre y actualiza el array en consecuencia
        $taldeEguneratuta = [
            'izena' => isset($datos['izena']) ? $datos['izena'] : null,
            'deleted_at' => null,
            'updated_at' => now()
        ];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Taldea::where('kodea', $kodea)->update($taldeEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un codigo de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $kodea)
    {
        $datos = $aux->all();
        $taldeEguneratuta = ["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Taldea::where('kodea', $kodea)->update($taldeEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $this->ezabatuLangile($kodea);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }

    
    public function ezabatuLangile($kodea)
    {
        $taldea = Taldea::where('kodea', $kodea)->first();

        if (!$taldea) {
            return response()->json(['error' => 'Taldea no encontrado'], 404);
        }

        // Actualiza la relación con la fecha de eliminación
        $taldea->langileak()->update(['deleted_at' => now()]);

        // Devuelve el resultado con un código de estado 200
        return response()->json(['success' => 'Registros eliminados correctamente'], 200);
    }
}