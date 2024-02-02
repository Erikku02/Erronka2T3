<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kolore_historiala;

class kolore_historiala_controller extends Controller
{
    public function index(){

        $datos = Kolore_historiala::with('prodktua')
            ->where('kolore_historiala.deleted_at',null)
            ->get();

        $result = $datos->map(function ($historiala) {
            return [
                "id" => $historiala->id,
                "id_bezeroa" => $historiala->id_bezeroa,
                "id_produktua" => $historiala->id_produktua,
                "izena" => $historiala->prodktua->izena,
                "marka" => $historiala->prodktua->marka,
                "data" => $historiala->data,
                "kantitatea" => $historiala->kantitatea,
                "bolumena" => $historiala->bolumena,
                "oharrak" => $historiala->oharrak,

            ];
        });
        return response()->json($result, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos=$aux->all();
        $nuevoHistorial=[
            "id_bezeroa"=>$datos["id_bezeroa"],
            "id_produktua"=>$datos["id_produktua"],
            "data"=>$datos["data"],
            "kantitatea"=>$datos["kantitatea"],
            "bolumena"=>$datos["bolumena"],
            "oharrak"=>$datos["oharrak"],
            "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Kolore_historiala::insert($nuevoHistorial);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoHistorial, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos=$aux->all();
        $updateHistorial=[
            "id"=>$datos["id"],
            "id_bezeroa"=>$datos["id_bezeroa"],
            "id_produktua"=>$datos["id_produktua"],
            "data"=>$datos["data"],
            "kantitatea"=>$datos["kantitatea"],
            "bolumena"=>$datos["bolumena"],
            "oharrak"=>$datos["oharrak"],
            "updated_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Kolore_historiala::where('id', $id)->update($updateHistorial);
        
        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $id)
    {
        $datos=$aux->all();
        $updateHistorial=["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Kolore_historiala::where('id', $id)->update($updateHistorial);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }


        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}
