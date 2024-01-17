<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiala extends Model
{
    protected $table = 'materiala';

    protected $primaryKey = 'id';

    protected $fillable = [
        'etiketa', 'izena', 'updated_at', 'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];
}