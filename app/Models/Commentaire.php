<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'content',
        'image',
        'user_id',
        'tags',
    ];



public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

public function message()
    {
        return $this->belongsTo('App\Models\Message');
    }

}