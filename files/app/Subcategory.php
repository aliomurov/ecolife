<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id'
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

    public function categoryproduct()
    {
        return $this->hasMany('App\Categoryproduct');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
