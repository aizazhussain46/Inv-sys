<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rturn extends Model
{
    protected $table = 'returns';
    protected $fillable = ['employee_id', 'inventory_id', 'remarks'];
}
