<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Txanda extends Model
{
    protected $table = 'txanda';

    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    public function langilea()
    {
        return $this->belongsTo(Langilea::class, 'id_langilea', 'id');
    }
}
