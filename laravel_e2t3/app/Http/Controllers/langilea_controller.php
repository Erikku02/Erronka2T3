<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Langilea;

class langilea_controller extends Controller
{
    //
    public function index(){
        $table = Langilea::all();
        return response()->json($table, 200);
    }

    public function erakutsi($id){
        $table = Langilea::where('id', $id)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/Langilearuta/1

    public function gorde(Request $aux)
    {
        $nuevoLangile = array(
            'izena' => $aux->input('izena'),
            'kodea' => $aux->input('kodea'),
            'abizenak' => $aux->input('abizenak'),
            'created_at' => now()
        );

        // Guarda el nuevo registro en la base de datos
        Langilea::insert($nuevoLangile);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoLangile, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        // Valida los datos del formulario según tus necesidades
        // $this->validate($aux, [
        //     'izena' => 'required',
        //     'kodea' => 'required',
        //     'abizenak' => 'required',
        // ]);

        $langileEguneratuta = Langilea::where('id', $id)->first();

        // Si no se encuentra el registro, devuelve un error 404
        if (!$langileEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $langileEguneratuta->update([
            'izena' => $aux->input('izena'),
            'kodea' => $aux->input('kodea'),
            'abizenak' => $aux->input('abizenak'),
            'updated_at' => now()
        ]);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($langileEguneratuta, 200);
    }


    public function ezabatu(Request $aux, $id)
    {
        $langileEguneratuta = Langilea::where('id', $id)->first();

        // Si no se encuentra el registro, devuelve un error 404
        if (!$langileEguneratuta) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $langileEguneratuta->update([
            'deleted_at' => now()
        ]);

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($langileEguneratuta, 200);
    }
}
