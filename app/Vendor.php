<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['vendor_name','address','contact_person','telephone','cell','email'];
}
