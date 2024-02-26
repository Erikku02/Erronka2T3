<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Erabiltzailea;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class erabiltzailea_controller extends Controller
{
    public function index()
    {
        $table = Erabiltzailea::all();
        return response()->json($table, 200);
    }

    public function erakutsi($username)
    {
        $table = Erabiltzailea::where('username', $username)->first();
        return response()->json($table, 200);
    }

    public function gorde(Request $aux)
    {
        $datos = $aux->all();
        $nuevoErabiltzaile = ["username" => $datos["username"], "pasahitza" => password_hash($datos["pasahitza"], PASSWORD_BCRYPT), "rola" => $datos["rola"], "created_at" => now()];

        // Guarda el nuevo registro en la base de datos
        Erabiltzailea::insert($nuevoErabiltzaile);

        // Datu-basean ondo gorde den erantzuna 201 status kodearekin itzuliko da
        return response()->json($nuevoErabiltzaile, 201);
    }

    public function eguneratu(Request $aux, $username)
    {
        $datos = $aux->all();

        // Verifica si se proporciona un nuevo nombre y actualiza el array en consecuencia
        $erabiltzaileEguneratuta = [
            'pasahitza' => password_hash($datos["pasahitza"], PASSWORD_BCRYPT),
            'rola' => isset($datos['rola']) ? $datos['rola'] : null,
            'deleted_at' => null,
            'updated_at' => now()
        ];

        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Erabiltzailea::where('username', $username)->update($erabiltzaileEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un codigo de estado 200
        return response()->json($eguneratuTaula, 200);
    }


    public function ezabatu(Request $aux, $username)
    {
        $datos = $aux->all();
        $taldeEguneratuta = ["deleted_at" => now()];
        // Actualiza los valores del modelo con los datos del formulario
        $eguneratuTaula = Erabiltzailea::where('username', $username)->update($taldeEguneratuta);

        // Si no se encuentra el registro, devuelve un error 404
        if (!$eguneratuTaula) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        // Devuelve el registro actualizado con un código de estado 200
        return response()->json($eguneratuTaula, 200);
    }
    /* 
    //* FUNCIONA(error: acepta el login aun cuando la contraseña este mal si el usuario es correcto)
        public function login(Request $request)
        {
            $username = $request->input('username');
            $password = $request->input('pasahitza');
            $user = Erabiltzailea::where('username', $username)->first();

            // echo $username;
            // echo $password;
            // echo $user;

            if ($user && Hash::check($password, $user->pasahitza)) {
                return response()->json(['message' => 'Autenticación exitosa'], 200);
            } else {
                // Autenticación fallida
                return response()->json(['error' => 'Credenciales incorrectas'], 401);
            }
        } */

    public function login(Request $request)
    {
        // echo "request" . $request;
        $username = $request->input('username');
        $password = $request->input('pasahitza');
        $user = Erabiltzailea::where('username', $username)->first();

        // echo $username;
        // echo $password;
        // echo " user->pasahitza: " . $user->pasahitza;
        // echo password_hash("1234", PASSWORD_BCRYPT);
        /* 
                echo "<prep>",
                    var_dump(password_verify($password, $user->pasahitza));
                echo "<prep>"; */

        // Verificar si el usuario existe y no ha sido borrado lógicamente
        if ($user && is_null($user->deleted_at)) {
            // Verificar si la contraseña es correcta
            if ($user->pasahitza && password_verify($password, $user->pasahitza)) {
                return response()->json(['message' => 'Autenticación exitosa'], 200);
            } else {
                // Contraseña incorrecta
                return response()->json(['error' => 'Credenciales incorrectas'], 401);
            }
        } else {
            // Usuario no encontrado o eliminado lógicamente
            return response()->json(['error' => 'Usuario no encontrado o desactivado'], 401);
        }

    }
}
