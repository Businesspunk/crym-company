<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dialog extends Model
{
    public $timestamps = false;
    public $fillable = ['one_side_id', 'other_side_id', 'post_id'];

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function getOponent($iam)
    {
        $opponent_id;

        if( $this->one_side_id != $iam ){
            $opponent_id = $this->one_side_id;
        }else{
            $opponent_id = $this->other_side_id;
        }

        return User::findOrFail( $opponent_id );
    }

    public function isParticipant( $id)
    {
        if( $this->one_side_id == $id || $this->other_side_id == $id ){
            return true;
        }
        return false;
    }

    public function getLastMessage()
    {
        if( $this->messages->count() == 0 ){
            return null;
        }
        
        return $this->messages()->orderBy('id', 'desc')->get()[0];
    }

}
