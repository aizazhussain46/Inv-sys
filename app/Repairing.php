<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repairing extends Model
{
    protected $fillable = ['category_id','subcategory_id','item_id', 'date', 'actual_price_value', 'price_value', 'remarks'];

    protected $with = [
        'category:id,category_name',
        'subcategory:id,sub_cat_name',
        'item:id,product_sn,make_id,model_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    public function item()
    {
        return $this->belongsTo('App\Inventory');
    }
}
