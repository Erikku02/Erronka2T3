<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bezero_fitxa extends Model
{
    
    protected $table = 'bezero_fitxa';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'izena','abizena','telefonoa','azal_sentikorra', 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'id',
    ];
}
