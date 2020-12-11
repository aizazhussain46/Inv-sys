<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $table = 'models';
    protected $fillable = ['model_name'];
}
