<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Txanda;

class txanda_controller extends Controller
{
    public function index()
    {
        $datos = Txanda::with('langilea')
                    ->whereHas('langilea', function ($query) {
                        $query->where('langilea.deleted_at', null);
                    })
                    ->get();

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

    public function erakutsi($kodea)
    {
        $datos = Txanda::with('langilea')
                    ->whereHas('langilea', function ($query) use ($kodea) {
                        $query->where('langilea.deleted_at', null);
                        $query->where('kodea', $kodea);
                    })
                    ->get();

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

        $nuevoTxanda = ["mota"=>$datos["mota"], "data"=> now(), "id_langilea"=>$datos["id_langilea"], "created_at" => now()];
        // Guarda el nuevo registro en la base de datos
        Txanda::insert($nuevoTxanda);

        // Datu-basean ondo gorde den erantzuna 201 status idrekin itzuliko da
        return response()->json($nuevoTxanda, 201);
    }

    public function azkenMostradorea($kodea)
    {
        $ultimoRegistro = Txanda::with('langilea')
            ->whereHas('langilea', function ($query) use ($kodea) {
                $query->where('langilea.deleted_at', null);
                $query->where('kodea', $kodea);
                $query->where('mota', "M");
            })
            ->whereDate('created_at', '=', now()->toDateString()) // Agregar filtro por la fecha de hoy
            ->latest()  // Ordena por fecha en orden descendente
            ->first();  // Obtiene solo el primer registro

        if (!$ultimoRegistro) {
            // Manejar el caso en que no se encuentra ningún registro
            return response()->json([], 404);
        }

        $result = [
            "id_langilea" => $ultimoRegistro->id_langilea,
            "mota" => $ultimoRegistro->mota,
            "izena" => $ultimoRegistro->langilea->izena,
            "abizenak" => $ultimoRegistro->langilea->abizenak,
            "kodea" => $ultimoRegistro->langilea->kodea,
        ];
        return response()->json($result, 200);
    }

    public function azkenBiGarbiketa($kodea)
    {
        $ultimosRegistros = Txanda::select('id', 'id_langilea', 'mota', 'created_at')
            ->with('langilea')
            ->whereHas('langilea', function ($query) use ($kodea) {
                $query->where('langilea.deleted_at', null);
                $query->where('kodea', $kodea);
                $query->where('mota', 'G');
            })
            ->whereDate('created_at', '=', now()->toDateString()) // Agregar filtro por la fecha de hoy
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
    
        if ($ultimosRegistros->isEmpty()) {
            // Manejar el caso en que no se encuentran registros
            return response()->json([], 404);
        }
    
        // Asegurémonos de que el segundo registro tenga un id_langilea diferente al del primer registro
        if ($ultimosRegistros->count() === 2 && $ultimosRegistros[0]->id_langilea === $ultimosRegistros[1]->id_langilea) {
            // Intenta encontrar un tercer registro con un id_langilea diferente
            $tercerRegistro = Txanda::where('id', '!=', $ultimosRegistros[0]->id)
                ->where('id_langilea', '!=', $ultimosRegistros[0]->id_langilea)
                ->whereHas('langilea', function ($query) use ($kodea) {
                    $query->where('kodea', $kodea);
                    $query->where('mota', 'G');
                })
                ->orderBy('created_at', 'desc')
                ->first();
    
            // Si se encontró un tercer registro, úsalo en lugar del segundo
            if ($tercerRegistro) {
                $ultimosRegistros[1] = $tercerRegistro;
            }
        }
    
        $result = $ultimosRegistros->map(function ($txanda) {
            return [
                "id_langilea" => $txanda->id_langilea,
                "mota" => $txanda->mota,
                "izena" => $txanda->langilea->izena,
                "abizenak" => $txanda->langilea->abizenak,
                "kodea" => $txanda->langilea->kodea,
            ];
        });
    
        return response()->json($result, 200);
    }
}