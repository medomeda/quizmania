<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = [
        'libelle',
        'question_id',
        'quiz_id',
        'correcte'
    ];

    
}
