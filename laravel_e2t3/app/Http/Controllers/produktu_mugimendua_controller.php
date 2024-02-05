<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produktu_mugimendua;
use App\Models\Produktua;

class produktu_mugimendua_controller extends Controller
{
    // public function index(){
    //     $table = Produktu_mugimendua::all();
    //     return response()->json($table, 200);
    // }

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
    
    // public function ateraMarka()
    // {
    //     $datos = Produktua::with('kategoria')->get();
    //     $result = $datos->map(function ($produktua) {
    //         return [
    //             "id_kategoria" => $produktua->id_kategoria,
    //             "marka" => $produktua->marka,
    //         ];
    //     });
    //     return response()->json($result, 200);
    // }

    // public function erakutsi($id)
    // {
    //     $table = Produktua::where('id', $id)->first();
    //     return response()->json($table, 200);
    // }

    // //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    // // public function gorde(Request $aux)
    // // {
    // //     $datos = $aux->all();
    // //     $nuevoProducto = [
    // //         "izena" => $datos["izena"],
    // //         "deskribapena" => $datos["deskribapena"],
    // //         "id_kategoria" => $datos["id_kategoria"],
    // //         "marka" => $datos["marka"],
    // //         "stock" => $datos["stock"],
    // //         "stock_alerta" => $datos["stock_alerta"],
    // //         "created_at" => now()
    // //     ];

    // //     // Guarda el nuevo registro en la base de datos
    // //     Produktua::insert($nuevoProducto);

    // //     // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
    // //     return response()->json($nuevoProducto, 201);
    // // }



    // public function eguneratu(Request $aux, $id)
    // {
    //     $datos = $aux->all();
    //     $produktuEguneratuta = [
    //         "id" => $datos["id"],
    //         "izena" => $datos["izena"],
    //         "deskribapena" => $datos["deskribapena"],
    //         "id_kategoria" => $datos["id_kategoria"],
    //         "marka" => $datos["marka"],
    //         "stock" => $datos["stock"],
    //         "stock_alerta" => $datos["stock_alerta"],
    //         "updated_at" => now()
    //     ];
    //     // Actualiza los valores del modelo con los datos del formulario
    //     $eguneratuTaula = Produktua::where('id', $id)->update($produktuEguneratuta);

    //     // Si no se encuentra el registro, devuelve un error 404
    //     if (!$eguneratuTaula) {
    //         return response()->json(['error' => 'Registro no encontrado'], 404);
    //     }

    //     // Devuelve el registro actualizado con un código de estado 200
    //     return response()->json($eguneratuTaula, 200);
    // }


    // public function ezabatu(Request $aux, $id)
    // {
    //     $datos = $aux->all();
    //     $produktuEguneratuta = ["deleted_at" => now()];
    //     // Actualiza los valores del modelo con los datos del formulario
    //     $eguneratuTaula = Produktua::where('id', $id)->update($produktuEguneratuta);

    //     // Si no se encuentra el registro, devuelve un error 404
    //     if (!$eguneratuTaula) {
    //         return response()->json(['error' => 'Registro no encontrado'], 404);
    //     }


    //     // Devuelve el registro actualizado con un código de estado 200
    //     return response()->json($eguneratuTaula, 200);
    // }
}