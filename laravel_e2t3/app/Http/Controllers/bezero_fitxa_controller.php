<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bezero_fitxa;

class bezero_fitxa_controller extends Controller
{
    public function index(){
        $table = Bezero_fitxa::all();
        return response()->json($table, 200);
    }

    public function erakutsi($id){
        $table = Bezero_fitxa::where('id', $id)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos=$aux->all();
        $nuevoFitxa=[
            "izena"=>$datos["izena"],
            "abizena"=>$datos["abizena"],
            "telefonoa"=>$datos["telefonoa"],
            "azal_sentikorra"=>$datos["azal_sentikorra"],
            "created_at" => now()
        ];

        // Guarda el nuevo registro en la base de datos
        Bezero_fitxa::insert($nuevoFitxa);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoFitxa, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos=$aux->all();
        $fitxaEguneratuta=[
            "id"=>$datos["id"],
            "izena"=>$datos["izena"],
            "abizena"=>$datos["abizena"],
            "telefonoa"=>$datos["telefonoa"],
            "azal_sentikorra"=>$datos["azal_sentikorra"],
            "updated_at" => now()
        ];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Bezero_fitxa::where('id', $id)->update($fitxaEguneratuta);
        
        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $id)
    {
        $datos=$aux->all();
        $fitxaEguneratuta=["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Bezero_fitxa::where('id', $id)->update($fitxaEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }


        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}
