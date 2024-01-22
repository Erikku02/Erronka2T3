<?php

namespace App\Http\Controllers;

use App\Models\Materiala_erabili;

use Illuminate\Http\Request;

class materiala_erabili_controller extends Controller
{
    public function index()
    {
        $table = Materiala_erabili::all();
        return response()->json($table, 200);
    }


    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoMaterialaErabili = ["id_materiala" => $datos["id_materiala"], "id_langilea" => $datos["id_langilea"], "hasiera_data" => $datos["hasiera_data"], "amaiera_data" => $datos["amaiera_data"], "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Materiala_erabili::insert($nuevoMaterialaErabili);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoMaterialaErabili, 201);
    }

    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $materialaErabiliEguneratuta = ["id" => $datos["id"], "id_materiala" => $datos["id_materiala"], "id_langilea" => $datos["id_langilea"], "hasiera_data" => $datos["hasiera_data"], "amaiera_data" => $datos["amaiera_data"], "updated_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Materiala_erabili::where("id", $id)->update($materialaErabiliEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$materialaErabiliEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }

    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $materialaErabiliEguneratuta = ["deleted_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Materiala_erabili::where('id', $id)->update($materialaErabiliEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un codigo de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}



// {
//     "id": 2,
//     "id_materiala": 4,
//     "id_langilea": 1,
//     "hasiera_data": "2024-01-03 13:24:25",
//     "amaiera_data": "2024-01-25 13:24:25",
//     "created_at": "2024-01-18T13:24:34.000000Z",
//     "updated_at": "2024-01-18T13:24:34.000000Z",
//     "deleted_at": null
// }