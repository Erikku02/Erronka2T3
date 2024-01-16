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
        $datos = $aux->all();
        $nuevoHorario = ["kodea"=>$datos["kodea"], "eguna"=>$datos["eguna"], "hasiera_data"=>$datos["hasiera_data"], "amaiera_data"=>$datos["amaiera_data"], "hasiera_ordua"=>$datos["hasiera_ordua"], "amaiera_ordua"=>$datos["amaiera_ordua"] , "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Ordutegia::insert($nuevoHorario);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoHorario, 201);
    }

    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $ordutegiEguneratuta = ["id"=>$datos["id"],"kodea"=>$datos["kodea"], "eguna"=>$datos["eguna"], "hasiera_data"=>$datos["hasiera_data"], "amaiera_data"=>$datos["amaiera_data"], "hasiera_ordua"=>$datos["hasiera_ordua"], "amaiera_ordua"=>$datos["amaiera_ordua"],"updated_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Ordutegia::where('id', $id)->update($ordutegiEguneratuta);        
        // Si no se encuentra el registro, devuelve un error 404
        if (!$ordutegiEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($ordutegiEguneratuta, 200);
    }

    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $ordutegiEzabatuta = ["deleted_at" => now()];
        $eguneratuTaula = Ordutegia::where('id', $id)->update($ordutegiEzabatuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$ordutegiEzabatuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $ordutegiEzabatuta->update([
            'deleted_at' => now()
        ]);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($ordutegiEzabatuta, 200);
    }

}
