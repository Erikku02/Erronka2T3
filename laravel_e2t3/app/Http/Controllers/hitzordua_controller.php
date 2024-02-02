<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hitzordua;

class hitzordua_controller extends Controller
{
    /* public function index()
    {
        $table = Hitzordua::all();
        return response()->json($table, 200);
    } */

    public function index()
    {
        $datos = Hitzordua::whereNull('deleted_at')
            ->with('langilea')->get();



        $result = $datos->map(function ($hitzordua) {
            // Comprobar que langilea no es null antes de acceder a sus datos
            $langilea = $hitzordua->langilea;

            // Convertir las cadenas a objetos DateTime
            $hasieraOrd = \DateTime::createFromFormat('H:i:s', $hitzordua->hasiera_ordua);
            $amaieraOrd = \DateTime::createFromFormat('H:i:s', $hitzordua->amaiera_ordua);

            /// Utilizar optional para manejar valores nulos
            $hasieraOrdErreala = optional(\DateTime::createFromFormat('H:i:s', $hitzordua->hasiera_ordua_erreala));
            $amaieraOrdErreala = optional(\DateTime::createFromFormat('H:i:s', $hitzordua->amaiera_ordua_erreala));

            // Convertir DateTime a Carbon
            $hasieraOrd = \Carbon\Carbon::instance($hasieraOrd);
            $amaieraOrd = \Carbon\Carbon::instance($amaieraOrd);

            // Verificar que las fechas se hayan creado correctamente
            if (!$hasieraOrd || !$amaieraOrd) {
                // Manejar el error o devolver un valor predeterminado
                return null; // Puedes ajustar esto según tus necesidades
            }

            // Calcular las duraciones solo si las fechas no son nulas
            $duracion_aprox = $hasieraOrd->diffInMinutes($amaieraOrd);

            // Verificar si hasiera_ordua_erreala y amaiera_ordua_erreala no son nulos
            if ($hasieraOrdErreala->value && $amaieraOrdErreala->value) {
                $hasieraOrdErreala = \Carbon\Carbon::instance($hasieraOrdErreala);
                $amaieraOrdErreala = \Carbon\Carbon::instance($amaieraOrdErreala);
                $duracion_real = $hasieraOrdErreala->diffInMinutes($amaieraOrdErreala);
            } else {
                $duracion_real = null;
            }

            /*  // Convertir DateTime a Carbon
            $hasieraOrd = \Carbon\Carbon::instance($hasieraOrd);
            $amaieraOrd = \Carbon\Carbon::instance($amaieraOrd);
             // $hasieraOrdErreala = \Carbon\Carbon::instance($hasieraOrdErreala);
             // $amaieraOrdErreala = \Carbon\Carbon::instance($amaieraOrdErreala); */

            return [
                'id' => $hitzordua->id,
                'eserlekua' => $hitzordua->eserlekua,
                'data' => $hitzordua->data,
                'hasiera_ordua' => $hitzordua->hasiera_ordua,
                'amaiera_ordua' => $hitzordua->amaiera_ordua,
                'hasiera_ordua_erreala' => $hitzordua->hasiera_ordua_erreala,
                'amaiera_ordua_erreala' => $hitzordua->amaiera_ordua_erreala,
                'duracion_aprox' => $duracion_aprox,
                'duracion_real' => $duracion_real,
                'izena' => $hitzordua->izena,
                'telefonoa' => $hitzordua->telefonoa,
                'deskribapena' => $hitzordua->deskribapena,
                'etxekoa' => $hitzordua->etxekoa,
                'prezio_totala' => $hitzordua->prezio_totala,
                'id_langilea' => $hitzordua->id_langilea,
                /* 'l_izena' => $hitzordua->langilea->izena, */
                'created_at' => now(),
            ];
        });

        return response()->json($result, 200);
    }

    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoHitzordua = [
            'eserlekua' => $datos['eserlekua'],
            'data' => $datos['data'],
            'hasiera_ordua' => $datos['hasiera_ordua'],
            'amaiera_ordua' => $datos['amaiera_ordua'],
            'hasiera_ordua_erreala' => $datos['hasiera_ordua_erreala'],
            'amaiera_ordua_erreala' => $datos['amaiera_ordua_erreala'],
            'izena' => $datos['izena'],
            'telefonoa' => $datos['telefonoa'],
            'deskribapena' => $datos['deskribapena'],
            'etxekoa' => $datos['etxekoa'],
            'prezio_totala' => $datos['prezio_totala'],
            'id_langilea' => $datos['id_langilea'],
            'created_at' => now()
        ];

        // Guarda el nuevo registro en la base de datos
        Hitzordua::insert($nuevoHitzordua);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoHitzordua, 201);

        /* para pruebas
        {
        "eserlekua": 50,
        "data": "2024-01-24",
        "hasiera_ordua": "12:45:37",
        "amaiera_ordua": "12:45:38",
        "hasiera_ordua_erreala": null,
        "amaiera_ordua_erreala": null,
        "izena": "prueba",
        "telefonoa": "777777777",
        "deskribapena": "wwwww",
        "etxekoa": "k",
        "prezio_totala": "0",
        "id_langilea": 6,
        "created_at": "2024-01-24T12:55:55.000000Z"

    } */
    }

    public function eguneratu(Request $aux, $id)
    {
        $datos = $aux->all();
        $hitzorduaEguneratuta = [
            'eserlekua' => $datos['eserlekua'],
            'hasiera_ordua' => $datos['hasiera_ordua'],
            'amaiera_ordua' => $datos['amaiera_ordua'],
            'hasiera_ordua_erreala' => $datos['hasiera_ordua_erreala'],
            'amaiera_ordua_erreala' => $datos['amaiera_ordua_erreala'],
            'deskribapena' => $datos['deskribapena'],
            'prezio_totala' => $datos['prezio_totala'],
            'id_langilea' => $datos['id_langilea'],
            'updated_at' => now()
        ];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Hitzordua::where('id', $id)->update($hitzorduaEguneratuta);

        if (!$eguneratuTaula) {
            return response()->json(['error' => 'registro no encontrado'], 404);
        }

        // Devuelve el registro del modelo con los datos del formulario
        return response()->json($eguneratuTaula, 200);
    }

    /* para las pruebas
    {
        "eserlekua": 50,
        "data": "2024-01-24",
        "hasiera_ordua": "12:45:37",
        "amaiera_ordua": "12:45:38",
        "hasiera_ordua_erreala": "12:45:37",
        "amaiera_ordua_erreala": null,
        "izena": "prueba",
        "telefonoa": "777777777",
        "deskribapena": "wwwww",
        "etxekoa": "k",
        "prezio_totala": "0",
        "id_langilea": 6,
        "created_at": "2024-01-24T12:55:55.000000Z"

    } */

    public function ezabatu(Request $aux, $id)
    {
        $datos = $aux->all();
        $ezabatuHitzordua = ['deleted_at' => now()];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Hitzordua::where('id', $id)->update($ezabatuHitzordua);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$ezabatuHitzordua) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        return response()->json($eguneratuTaula, 200);
    }
}