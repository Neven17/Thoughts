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
        return ($user->is_admin || $user->is($model));   // Samo korisnik svojeg profila moze nesto editovat i ako je admin
        //U ovom slučaju, $user predstavlja trenutnog korisnika koji je prijavljen na sustav,
        // dok $model predstavlja korisnika koji se želi ažurirati. Ako su ti korisnici isti, funkcija će vratiti true, inače će vratiti false.
    }

    public function delete(User $user, User $model): bool
    {
        // i ovo je kao destroy

        return ($user->is_admin || $user->is( $model) );
    }


    
}
