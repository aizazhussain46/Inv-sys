<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dollar extends Model
{
    protected $guarded = [];

    protected $with = [
        'year:id,year'
    ];

    public function year()
    {
        return $this->belongsTo('App\Year');
    }
}
