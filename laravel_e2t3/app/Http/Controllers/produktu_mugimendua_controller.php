<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produktu_mugimendua;
use App\Models\Produktua;

class produktu_mugimendua_controller extends Controller
{
    public function index()
    {
        $datos = Produktu_mugimendua::with('produktua.kategoria', 'langilea')->get();
        $result = $datos->map(function ($produktuMugimendua) {
            return [
                "id" => $produktuMugimendua->id,
                "produktua" => [
                    "id" => $produktuMugimendua->produktua->id,
                    "izena" => $produktuMugimendua->produktua->izena,
                    "marka" => $produktuMugimendua->produktua->marka,
                    "deskribapena" => $produktuMugimendua->produktua->deskribapena,
                    "kategoria" => [
                        "id" => $produktuMugimendua->produktua->kategoria->id,
                        "izena" => $produktuMugimendua->produktua->kategoria->izena,
                    ],
                ],
                "langilea" => [
                    "id" => $produktuMugimendua->langilea->id,
                    "izena" => $produktuMugimendua->langilea->izena,
                ],
                "kopurua" => $produktuMugimendua->kopurua,
                "data" => $produktuMugimendua->data,
            ];
        });
        return response()->json($result, 200);
    }

    public function gorde(Request $aux)
    {
        $datos = $aux->all();

        foreach ($datos as $dato) {
            if (
                isset($dato["id_produktua"]) &&
                isset($dato["id_langilea"]) &&
                isset($dato["kopurua"])
            ) {
                $nuevoProduktuMugimendu = [
                    "id_langilea" => $dato["id_langilea"],
                    "id_produktua" => $dato["id_produktua"],
                    "data" => now(),
                    "kopurua" => $dato["kopurua"],
                    "created_at" => now()
                ];

                // Guarda el nuevo registro en la base de datos
                $produktuMugimendua = Produktu_mugimendua::create($nuevoProduktuMugimendu);

                // Actualiza la cantidad en la relación Eloquent
                $produktuMugimendua->produktua->decrement('stock', $dato['kopurua']);
            } else {
                // Si faltan datos necesarios en algún conjunto, devuelve un error 400 Bad Request
                return response()->json(['error' => 'Faltan datos necesarios'], 400);
            }
        }
        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json(['message' => 'Datos guardados correctamente'], 201);
    }
}