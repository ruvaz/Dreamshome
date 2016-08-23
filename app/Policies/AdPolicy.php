<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Ad;
use App\User;

class AdPolicy
{
    use HandlesAuthorization;


//    public function before($user, $ability)
//    {
////        if ($user->isSuperAdmin()) {
////            return true;
////        }
//    }


    public function update(User $user, Ad $ad)
    {

        return $user->owns($ad); //validar si puede actualizarlo

    }


    /**
     * Validar que el usuario es dueño del Anuncio,
     * usuario que desea modificar la info del anuncio
     * @return bool
     */
    public function owner(User $user, Ad $ad)
    {

        $userId = (string)$user->id;
        $adUserId = $ad->user_id; //null

        return $userId == $adUserId;
        // return $user->id == $ad->user_id; //si es el mismo usuario   /uso en controlador
    }

}
