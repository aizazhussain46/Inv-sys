<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'category_id',
        'location_id',
        'department_id',
        'branch_id',
        'store_id',
        'model_id',
        'make_id',
        'vendor_id',
        'device_type',
        'product_sn',
        'purchase_date',
        'item_nature',
        'item_price',
        'remarks',
        'delivery_challan',
        'delivery_challan_date',
        'invoice_number',
        'invoice_date',
        'other_accessories',
        'purpose',
        'good_condition',
        'verification',
        'issued_to',
        'issued_by'
    ];

    protected $with = [
        'category:id,category_name',
        'branch:id,branch_name',
        'department:id,department_name',
        'location:id,location',
        'store:id,store_name',
        'model:id,model_name',
        'make:id,make_name',
        'vendor:id,vendor_name'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function model()
    {
        return $this->belongsTo('App\Modal');
    }
    public function make()
    {
        return $this->belongsTo('App\Makee');
    }
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
