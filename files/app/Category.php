<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name', 'slug'
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

    public function subcategory()
    {
        return $this->hasMany('App\Subcategory');
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
