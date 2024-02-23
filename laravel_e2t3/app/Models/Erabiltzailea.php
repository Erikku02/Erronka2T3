<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Erabiltzailea extends Model implements Authenticatable
{

    use AuthenticatableTrait;
    protected $table = 'erabiltzailea';

    protected $primaryKey = 'username';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'pasahitza',
        'rola',
        'updated_at',
        'deleted_at',
    ];

    /* protected $hidden = [
        'username',
    ]; */

    /* public function validateCredentials(array $credentials)
    {
        $username = $credentials['username'];
        $pasahitza = $credentials['pasahitza'];

        // Buscar el usuario por su nombre de usuario
        $user = static::where('username', $username)->first();

        // Verificar si se encontro el usuario y si la contraseña coincide
        if ($user && \Hash::check($pasahitza, $user->pasahitza)) {
            return true;
        }
        return false;
    } */
}
