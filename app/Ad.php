<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Ad Anuncio class
 * @package App
 */
class Ad extends Model
{
    use SoftDeletes;


    /**
     * campos rellenables
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int'
    ];

    protected $dates = ['deleted_at'];


    /**
     * Usuario del Anuncio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }






}
