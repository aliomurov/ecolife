<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Rateable;

    protected $fillable = [
        'subcategory_id',
        'category_id',
        'brand_id',
        'country_id',
        'categoryproduct_id',
        'name',
        'slug',
        'kod',
        'price',
        'gram',
        'image',
        'views',
        'description',
        'structure',
        'preparation',
        'new',
        'sale',
        'old_price',
        'available'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function categoryproduct()
    {
        return $this->belongsTo('App\Categoryproduct');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function presentPrice()
    {
        return number_format($this->price);
    }

    public function presentOldPrice()
    {
        return number_format($this->old_price);
    }

    public function wish()
    {
        return $this->belongsTo('App\Wish');
    }
}
