<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repairing extends Model
{
    protected $fillable = ['item_id', 'date', 'actual_price_value', 'price_value', 'remarks'];
}
