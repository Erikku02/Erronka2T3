<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taldea extends Model
{
    
    protected $table = 'taldea';

    protected $primaryKey = 'kodea';

    protected $keyType = 'string';

    protected $fillable = [
        'izena', 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'kodea',
    ];
}
