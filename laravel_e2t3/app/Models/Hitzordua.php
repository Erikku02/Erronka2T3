<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hitzordua extends Model
{
    protected $table = 'hitzordua';

    protected $primaryKey = 'id';

    protected $fillable = [
        'eserlekua',
        'data',
        'hasiera_ordua',
        'amaiera_ordua',
        'hasiera_ordua_erreala',
        'amaiera_ordua_erreala',
        'izena',
        'telefonoa',
        'deskribapena',
        'etxekoa',
        'prezio_totala',
        'id_langilea',
        'sortze_data',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id'
    ];
}