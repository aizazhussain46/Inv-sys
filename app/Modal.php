<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $table = 'models';
    protected $fillable = ['model_name','make_id','status'];

    protected $with = [
        'make:id,make_name'
    ];

    public function make()
    {
        return $this->belongsTo('App\Makee');
    }
}
