<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'location_id',
        'department_id',
        'branch_id',
        'store_id',
        'model_id',
        'make_id',
        'vendor_id',
        'devicetype_id',
        'inventorytype_id',
        'product_sn',
        'purchase_date',
        'itemnature_id',
        'item_price',
        'dollar_rate',
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
        'year_id',
        'added_by',
        'issued_by',
        'status',
        'po_number',
        'warrenty_period',
        'insurance',
        'licence_key',
        'sla',
        'warrenty_check',
        'operating_system',
        'SAP_tag',
        'capacity',
        'hard_drive',
        'processor',
        'process_generation',
        'display_type',
        'DVD_rom',
        'RAM'
    ];

    protected $with = [
        'category:id,category_name',
        'subcategory:id,sub_cat_name',
        'branch:id,branch_name',
        'department:id,department_name',
        'location:id,location',
        'store:id,store_name',
        'model:id,model_name',
        'make:id,make_name',
        'inventorytype:id,inventorytype_name',
        'vendor:id,vendor_name,contact_person',
        'itemnature:id,itemnature_name',
        'devicetype:id,devicetype_name'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
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
    public function inventorytype()
    {
        return $this->belongsTo('App\Inventorytype');
    }
    public function itemnature()
    {
        return $this->belongsTo('App\Itemnature');
    }
    public function devicetype()
    {
        return $this->belongsTo('App\Devicetype');
    }
}
