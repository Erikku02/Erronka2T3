<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategoria;

class kategoria_controller extends Controller
{
    public function index(){
        $table = Kategoria::all();
        return response()->json($table, 200);
    }

    public function erakutsi($id){
        $table = Kategoria::where('id', $id)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos=$aux->all();
        $nuevaKategoria=["izena"=>$datos["izena"],"created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Kategoria::insert($nuevaKategoria);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevaKategoria, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos=$aux->all();
        $kategoriaEguneratuta=["id"=>$datos["id"],"izena"=>$datos["izena"],"updated_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Kategoria::where('id', $id)->update($kategoriaEguneratuta);
        
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
        $kategoriaEguneratuta=["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Kategoria::where('id', $id)->update($kategoriaEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }


        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}
