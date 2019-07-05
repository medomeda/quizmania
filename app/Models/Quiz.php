<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizes';
    
    protected $fillable = [
        'libelle',
        'description'
    ];
}
