<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function delete(User $user, User $model)
    {   
        if( $user->id == 1 && $user->id != $model->id ){
            return true;
        }
        return false;
    }
    
}
