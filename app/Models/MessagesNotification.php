<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagesNotification extends Model
{
    public $table = "messagesNotification";
    public $fillable = ['user_id'];

    public static function makeNotification( $id )
    {
        MessagesNotification::updateOrCreate([
            'user_id' => $id
        ]);
    }
}
