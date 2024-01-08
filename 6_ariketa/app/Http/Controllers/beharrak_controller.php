<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beharrak;

class beharrak_controller extends Controller
{
    public function index(){
        $table = Beharrak::all();
        return response()->json($table, 200);
    }

    public function erakutsi($id){
        $table = Beharrak::find($id);
        return response()->json($table, 200);
    }

    //probamos así http://localhost/Laravel/6_ariketa_Laravel_APIRestful/public/api/beharrakruta/1

    public function gorde(Request $aux)
    {
        // Valida los datos del formulario según tus necesidades
        $this->validate($aux, [
            'izena' => 'required',
            'deskribapena' => 'required',
        ]);

        // Eloquent erabiliz modeloa sortu
        $nuevoBeharra = new Beharrak;

        // Asigna los valores del formulario al modelo directamente desde el request
        $nuevoBeharra->izena = $aux->input('izena');
        $nuevoBeharra->deskribapena = $aux->input('deskribapena');

        // Guarda el nuevo registro en la base de datos
        $nuevoBeharra->save();

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoBeharra, 201);
    }

    public function eguneratu(Request $aux, $id)
    {
        // Valida los datos del formulario según tus necesidades
        $this->validate($aux, [
            'izena' => 'required',
            'deskribapena' => 'required',
        ]);

        // Busca el registro que deseas actualizar por su ID
        $beharra = Beharrak::find($id);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$beharra) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Actualiza los valores del modelo con los datos del formulario
        $beharra->izena = $aux->input('izena');
        $beharra->deskribapena = $aux->input('deskribapena');

        // Guarda los cambios en la base de datos
        $beharra->save();

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($beharra, 200);
    }

    public function ezabatu($id)
    {
         // Busca el registro que deseas eliminar por su ID
        $beharra = Beharrak::find($id);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$beharra) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Elimina el registro de la base de datos
        $beharra->delete();

        // Devuelve una respuesta exitosa con un código de estado 204 (sin contenido)
        return response()->json(null, 204);
    }
}
