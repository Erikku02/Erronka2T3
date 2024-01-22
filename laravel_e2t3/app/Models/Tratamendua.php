<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamendua extends Model
{
    
    protected $table = 'tratamendua';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = [
        'izena','etxeko_prezioa','kanpoko_prezioa', 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'id',
    ];
}
