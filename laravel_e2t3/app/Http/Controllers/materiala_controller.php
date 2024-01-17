<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiala;

class materiala_controller extends Controller
{
    public function index(){
        $table = Materiala::all();
        return response()->json($table, 200);
    }

    public function gorde(Request $aux) {
        $datos = $aux->all();
        
        $nuevoMateriala = ["etiketa" => $datos["etiketa"], "izena" => $datos["izena"], "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Materiala::insert($nuevoMateriala);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoMateriala, 201);

        
    }
}