<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'id_category','image'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'id_category', 'id_category');
    }

}
