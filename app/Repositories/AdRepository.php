<?php

namespace App\Repositories;

use App\Ad;
use App\User;

class AdRepository
{


    //Anuncios correspondientes al usuario

    public function forUser(User $user)
    {
        return Ad::where('user_id', $user->id)
            ->orderBy('created_at', 'des')
            ->get();
    }
}