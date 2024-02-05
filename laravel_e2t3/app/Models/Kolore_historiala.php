<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolore_historiala extends Model
{

    protected $table = 'kolore_historiala';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];

    public function prodktua()
    {
        return $this->belongsTo(Produktua::class, 'id_produktua', 'id');
    }
}