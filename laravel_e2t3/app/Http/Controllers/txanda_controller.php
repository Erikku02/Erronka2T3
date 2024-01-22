<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Txanda;

class txanda_controller extends Controller
{
    public function index()
    {
        $datos = Txanda::with('langilea')->get();

        $result = $datos->map(function ($txanda) {
            return [
                "id" => $txanda->id,
                "mota" => $txanda->mota,
                "data" => $txanda->data,
                "id_langilea" => $txanda->id_langilea,
                "izena" => $txanda->langilea->izena,
                "abizenak" => $txanda->langilea->abizenak,
                "kodea" => $txanda->langilea->kodea,
                "created_at" => now(),
            ];
        });
        return response()->json($result, 200);
    }

    public function gorde(Request $aux)
    {
        $datos=$aux->all();

        $nuevoTxanda = ["mota"=>$datos["mota"], "data"=>$datos["data"], "id_langilea"=>$datos["id_langilea"], "created_at" => now()];
        // Guarda el nuevo registro en la base de datos
        Txanda::insert($nuevoTxanda);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoTxanda, 201);
    }
}