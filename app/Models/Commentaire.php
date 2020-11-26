<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;


public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

public function message()
    {
        return $this->belongsTo('App\Models\Message', 'commentaire_id');
    }

}