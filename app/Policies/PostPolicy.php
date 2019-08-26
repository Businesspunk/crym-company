<?php

namespace App\Policies;

use App\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    
    public function delete(User $user, Post $post)
    {
        if($user->id === $post->user_id){
            return true;
        }

        $collection = $user->roles->keyBy('id');
        if( $collection->get(1) != null ){
            return true;
        }
        if( $collection->get(2) != null ){
            return true;
        }
        return false;
    }

    public function close(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function edit(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

}
