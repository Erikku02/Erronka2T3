<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tratamendua;
use App\Models\Langilea;
use App\Models\Hitzordua;
use App\Models\TicketLerroa;

class tratamendua_controller extends Controller
{
    public function langileTratamenduStats($talde){
        $stats = Tratamendua::join('ticket_lerroa', 'tratamendua.id', '=', 'ticket_lerroa.id_tratamendua')
                            ->join('hitzordua', 'ticket_lerroa.id_hitzordua', '=', 'hitzordua.id')
                            ->join('langilea', 'hitzordua.id_langilea', '=', 'langilea.id')
                            ->where('langilea.kodea', '=', $talde)
                            ->select('langilea.izena as izena', 'tratamendua.izena as tratamendua', 
                                    \DB::raw('COUNT(tratamendua.id) as kantitatea'))
                            ->groupBy('langilea.izena', 'tratamendua.izena')
                            ->orderBy('langilea.izena', 'asc')
                            ->orderBy('kantitatea', 'desc')
                            ->get();
        return response()->json($stats, 200);
    }
    

    public function index(){
        $table = Tratamendua::all();
        return response()->json($table, 200);
    }

    public function erakutsi($id){
        $table = Tratamendua::where('id', $id)->first();
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa/public/api/taldearuta/1

    public function gorde(Request $aux)
    {
        $datos=$aux->all();
        $nuevoTratamendua=[
            "izena"=>$datos["izena"],
            "etxeko_prezioa"=>$datos["etxeko_prezioa"],
            "kanpoko_prezioa"=>$datos["kanpoko_prezioa"],
            "created_at" => now()
        ];

        // Guarda el nuevo registro en la base de datos
        Tratamendua::insert($nuevoTratamendua);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoTratamendua, 201);
    }



    public function eguneratu(Request $aux, $id)
    {
        $datos=$aux->all();
        $tratamenduaEguneratuta=[
            "id"=>$datos["id"],
            "izena"=>$datos["izena"],
            "etxeko_prezioa"=>$datos["etxeko_prezioa"],
            "kanpoko_prezioa"=>$datos["kanpoko_prezioa"],
            "updated_at" => now()
        ];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Tratamendua::where('id', $id)->update($tratamenduaEguneratuta);
        
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
        $tratamenduaEguneratuta=["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Tratamendua::where('id', $id)->update($tratamenduaEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }


        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
}

