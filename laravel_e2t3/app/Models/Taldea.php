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

    public function langileak()
    {
        return $this->hasMany(Langilea::class, 'kodea', 'kodea')->whereNull('deleted_at');
    }
}
