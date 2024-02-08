<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_lerroa extends Model
{
    protected $table = 'ticket_lerroa';

    protected $primaryKey = 'id';

    protected $fillable = ['id_hitzordua', 'id_tratamendua', 'prezioa', 'updated_at', 'deleted_at'];

    protected $guarded = 'id';

    
}