<?php

namespace App\Http\Controllers;

use App\Models\Materiala_erabili;

use Illuminate\Http\Request;

class materiala_erabili_controller extends Controller
{

    public function index()
    {
        $datos = Materiala_erabili::with('langilea')->get();
        $result = $datos->map(function ($materialaErabili) {
            return [
                "id" => $materialaErabili->id,
                "langilea" => [
                    "id" => $materialaErabili->langilea->id,
                    "izena" => $materialaErabili->langilea->izena,
                ],
                "materiala" => [
                    "id" => $materialaErabili->materiala->id,
                    "etiketa" => $materialaErabili->materiala->etiketa,
                ],
                "hasiera_data" => $materialaErabili->hasiera_data,
                "amaiera_data" => $materialaErabili->amaiera_data
            ];
        });
        return response()->json($result, 200);
    }


    public function gorde(Request $aux)
    {
        // Obtén el conjunto de datos
        $dato = $aux->all();

        // Verifica si faltan datos necesarios
        if (
            isset($dato["id_materiala"]) &&
            isset($dato["id_langilea"])
        ) {
            $nuevoMaterialaErabili = [
                "id_materiala" => $dato["id_materiala"],
                "id_langilea" => $dato["id_langilea"],
                "hasiera_data" => now(),
                "created_at" => now()
            ];

            // Guarda el nuevo registro en la base de datos
            $materialaErabili = Materiala_erabili::create($nuevoMaterialaErabili);

            // Datos guardados correctamente, devuelve una respuesta 201
            return response()->json(['message' => 'Datos guardados correctamente'], 201);
        } else {
            // Si faltan datos necesarios, devuelve un error 400 Bad Request
            return response()->json(['error' => 'Faltan datos necesarios'], 400);
        }
    }


    public function ezabatu(Request $aux, $id)
    {
        // Obtén el conjunto de datos
        $dato = $aux->all();

        // Obtén el registro existente por su ID
        $materialaErabili = Materiala_erabili::find($id);

        // Verifica si se encontró el registro
        if (!$materialaErabili) {
            // Si no se encuentra el registro, devuelve un error 404 Not Found
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los campos existentes y agrega amaiera_data
        $materialaErabili->update([
            "amaiera_data" => now(),
            "updated_at" => now(), 
            "deleted_at" => now() 
        ]);
        // Datos actualizados correctamente, devuelve una respuesta 200
        return response()->json(['message' => 'Datos actualizados correctamente'], 200);
    }
}
