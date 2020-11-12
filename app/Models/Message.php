<?php

namespace App\Models;
use Carbon;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = ['message', 'dialog_id', 'user_id', 'isPhoto'];

    public function isAuthor( $id ){

        if( $this->user_id == $id ){
            return true;
        }
        return false;
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getTime()
    {
        $created = new Carbon( $this->created_at );
        $now = Carbon::now();
        $difference = $now->diffInSeconds($created);

        if( $difference < 24 * 60 * 60 ){
            $time = $this->created_at->format('H:i');
        }
        else{
            $time = $this->created_at->format('H:i, d.m.Y');
        }
        return $time;
    }

    public function getSomePart()
    {
        return substr($this->message, 0, 30) . '...' ;
    }
}
