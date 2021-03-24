<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['employee_id', 'inventory_id', 'year_id', 'remarks'];
}
