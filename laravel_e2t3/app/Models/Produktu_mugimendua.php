<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktu_mugimendua extends Model
{

    protected $table = 'produktu_mugimendua';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'id_produktua',
        'id_langilea',
        'data',
        'kopurua',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
    ];

    public function langilea()
    {
        return $this->belongsTo(Langilea::class, 'id_langilea');
    }
    public function produktua()
    {
        return $this->belongsTo(Produktua::class, 'id_produktua');
    }

    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, 'id_kategoria', 'id');
    }
}