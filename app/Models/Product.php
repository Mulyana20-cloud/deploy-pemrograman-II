<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{


    protected $fillable = [

        'category_id',

        'name',

        'sku',

        'slug',

        'description',

        'price',

        'discount_price',

        'stock',

        'image',

        'is_featured',

        'status',

    ];



    public function category()
    {

        return $this->belongsTo(Category::class);

    }


}