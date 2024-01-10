<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordutegia extends Model
{
    protected $table = 'ordutegia';

    protected $primaryKey = 'id';

    protected $fillable = [
        'eguna', 'hasiera_data','amaiera_data', 'hasiera_ordua' , 'amaiera_ordua' , 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'id',
    ];
}