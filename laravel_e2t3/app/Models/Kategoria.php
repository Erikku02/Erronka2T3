<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{

    protected $table = 'kategoria';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'izena',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];

    public function produktua()
    {
        return $this->hasMany(Produktua::class, 'id_kategoria');
    }
}