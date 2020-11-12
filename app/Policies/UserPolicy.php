<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function delete(User $user, User $model)
    {   
        $isAdmin = $user->roles->where('id', 1)->count() == 1;
        if( $user->id == 1 && $user->id != $model->id ){
            return true;
        }
        return false;
    }

    public function changepassword(User $user, User $model)
    {   
        $isAdmin = $user->roles->where('id', 1)->count() == 1;
        if( $isAdmin ){
            return true;
        }
        return false;
    }
    
}
