<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reponse;

class Question extends Model
{
    protected $fillable = [
        'intitule','reponse','quiz_id','categorie_id','points','media'
    ];

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }  
}
