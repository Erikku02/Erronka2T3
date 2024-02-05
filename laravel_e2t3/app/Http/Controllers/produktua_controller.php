<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produktua;

class produktua_controller extends Controller
{
    /*public function index(){
        $table = Produktua::all();
        return response()->json($table, 200);
    }*/

    public function index()
    {
        $datos = Produktua::with('kategoria')->get();
        $result = $datos->map(function ($produktua) {
            return [
                "id" => $produktua->id,
                "izena" => $produktua->izena,
                "deskribapena" => $produktua->deskribapena,
                "id_kategoria" => $produktua->id_kategoria,
                "k_izena" => $produktua->kategoria->izena, // nombre de la kategoria
                "marka" => $produktua->marka,
                "stock" => $produktua->stock,
                "stock_alerta" => $produktua->stock_alerta
            ];
        });
        return response()->json($result, 200);
    }

    public function ateraMarka()
    {
        $datos = Produktua::with('kategoria')->get();
        $result = $datos->map(function ($produktua) {
            return [
                "id_kategoria" => $produktua->id_kategoria,
                "marka" => $produktua->marka,
            ];
        });
        return response()->json($result, 200);
    }

    public function erakutsi($id)
    {
        $table = Produktua::where('id', $id)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoProducto = [
            "izena" => $datos["izena"],
            "deskribapena" => $datos["deskribapena"],
            "id_kategoria" => $datos["id_kategoria"],
            "marka" => $datos["marka"],
            "stock" => $datos["stock"],
            "stock_alerta" => $datos["stock_alerta"],
            "created_at" => now()
        ];

        // Guarda el nuevo registro en la base de datos
        Produktua::insert($nuevoProducto);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoProducto, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $produktuEguneratuta = [
            "id" => $datos["id"],
            "izena" => $datos["izena"],
            "deskribapena" => $datos["deskribapena"],
            "id_kategoria" => $datos["id_kategoria"],
            "marka" => $datos["marka"],
            "stock" => $datos["stock"],
            "stock_alerta" => $datos["stock_alerta"],
            "updated_at" => now()
        ];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Produktua::where('id', $id)->update($produktuEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $produktuEguneratuta = ["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Produktua::where('id', $id)->update($produktuEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }


        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}