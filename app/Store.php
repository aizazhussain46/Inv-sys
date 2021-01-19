<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['store_name','location_id','emp_id'];
    
    protected $with = [
        'location:id,location'
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
