<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiala_erabili extends Model
{
    protected $table = 'materiala_erabili';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_material',
        'id_langilea',
        'hasiera_data',
        'amaiera_data',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];
}