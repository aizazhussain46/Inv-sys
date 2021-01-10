<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['category_id','sub_cat_name','threshold','status'];

    protected $with = [
        'category:id,category_name'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
