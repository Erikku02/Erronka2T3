<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket_lerroa;

class ticket_lerroa_controller extends Controller
{
    public function index()
    {
        $table = Ticket_lerroa::all();
        return response()->json($table, 200);
    }

    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoTicketLerroa = [
            'id_hitzordua' => $datos['id_hitzordua'],
            'id_tratamendua' => $datos['id_tratamendua'],
            'prezioa' => $datos['prezioa'],
            'created_at' => now()
        ];

        // Guarda el nuevo registro en la base de datos
        Ticket_lerroa::insert($nuevoTicketLerroa);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoTicketLerroa, 200);
    }
}