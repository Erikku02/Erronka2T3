<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktua extends Model
{
    
    protected $table = 'produktua';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'izena','deskribapena','id_kategoria','marka','stock','stock_alerta', 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'id',
    ];
}