<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    public function state()
    {
        return $this->hasMany('App\State');
    }
}
