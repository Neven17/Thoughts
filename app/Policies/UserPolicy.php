<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
  

    

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return ($user->is_admin || $user->is($model));   
       
    }

    public function delete(User $user, User $model): bool
    {
        // i ovo je kao destroy

        return ($user->is_admin || $user->is( $model) );
    }


    
}
