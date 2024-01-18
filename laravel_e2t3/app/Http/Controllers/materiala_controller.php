<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiala;

class materiala_controller extends Controller
{
    public function index()
    {
        $table = Materiala::all();
        return response()->json($table, 200);
    }

    public function gorde(Request $aux)
    {
        $datos = $aux->all();

        $nuevoMateriala = ["etiketa" => $datos["etiketa"], "izena" => $datos["izena"], "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Materiala::insert($nuevoMateriala);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoMateriala, 201);
    }

    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $materialaEguneratuta = ["etiketa" => $datos["etiketa"], "izena" => $datos["izena"], "updated_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Materiala::where("id", $id)->update($materialaEguneratuta);

        if (!$eguneratuTaula) {
            return response()->json(['error' => 'registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un codigo de estado 200
        return response()->json($eguneratuTaula, 200);
    }

    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $ezabatuMateriala = ["deleted_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Materiala::where("id", $id)->update($ezabatuMateriala);

        // Si no se encuentra al registro, devuelve un error 404
        if (!$ezabatuMateriala) {
            return response()->json(["error" => "Registro no encontrado"], 404);
        }

        return response()->json($eguneratuTaula, 200);
    }
}