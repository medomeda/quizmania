<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Reponse extends Model
{
    protected $fillable = [
        'libelle',
        'question_id',
        'quiz_id',
        'correcte'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    
}
