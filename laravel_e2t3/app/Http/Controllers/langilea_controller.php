<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Langilea;
use App\Models\Txanda;

class langilea_controller extends Controller
{
    //
    public function index(){
        $table = Langilea::all();
        return response()->json($table, 200);
    }

    public function erakutsi($kodea){
        $table = Langilea::where('kodea', $kodea)->get();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/Langilearuta/1

    public function gorde(Request $aux)
    {
        $datos = $aux->all();

        $nuevoLangile = ["izena"=>$datos["izena"], "kodea"=>$datos["kodea"], "abizenak"=>$datos["abizenak"], "created_at" => now()];
        // Guarda el nuevo registro en la base de datos
        Langilea::insert($nuevoLangile);
        $id = ["id"=>$datos["id"]];
        echo $id;
        //insertTxanda($id);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoLangile, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $langileEguneratuta = ["id"=>$datos["id"], "izena"=>$datos["izena"], "abizenak"=>$datos["abizenak"], "updated_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Langilea::where('id', $id)->update($langileEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$langileEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $ezabatuLangile = ["deleted_at" => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Langilea::where('id', $id)->update($ezabatuLangile);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$ezabatuLangile) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }

    public function mostrarTablaTrabajadores()
    {
        $langileak = Langilea::with('txanda')->get();

        return response()->json(['langilea' => $langileak]);
    }

    public function insertTxanda($id_langilea){

        $nuevoTxanda = [["mota"=>$datos["M"], "data"=> now(), "id_langilea"=>$datos["id_langilea"], "created_at" => now()], 
        ["mota"=>$datos["G"], "data"=> now(), "id_langilea"=>$datos["id_langilea"], "created_at" => now()]];

        // Guarda el nuevo registro en la base de datos
        Txanda::insert($nuevoTxanda);

        return response()->json($nuevoTxanda, 201);
    }
}