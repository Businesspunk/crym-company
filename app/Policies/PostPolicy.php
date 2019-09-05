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

        if( $user->roles->where('id', 1)->count() == 1 ){
            return true;
        }
        elseif( $user->roles->where('id', 2)->count() == 1 ){
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

    public function vipPosting(User $user, Post $post)
    {
        return $user->roles->where('id', 1)->count() == 3;
    }

}
