<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['city', 'number', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
