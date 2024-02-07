<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiala_erabili extends Model
{
    protected $table = 'materiala_erabili';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_materiala',
        'id_langilea',
        'hasiera_data',
        'amaiera_data',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];
    
    public function materiala()
    {
        return $this->belongsTo(Materiala::class, 'id_materiala');
    }

    public function langilea()
    {
        return $this->belongsTo(Langilea::class, 'id_langilea');
    }
    
}