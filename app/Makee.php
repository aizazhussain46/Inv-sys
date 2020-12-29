<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makee extends Model
{
    protected $table = 'makes';
    protected $fillable = ['make_name','status'];
}
