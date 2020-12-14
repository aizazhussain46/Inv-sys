<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = ['from_employee_id', 'to_employee_id', 'inventory_id', 'remarks'];
}
