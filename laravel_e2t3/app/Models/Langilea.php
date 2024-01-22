<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langilea extends Model
{
    protected $table = 'langilea';

    protected $primaryKey = 'id';

    protected $fillable = [
        'izena', 'kodea','abizenak', 'updated_at', 'deleted_at', 
    ];

    protected $guarded = [
        'id',
    ];

    public function txanda(){
        return $this->hasMany(Txanda::class, 'id_langilea');
    }
}
