<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
