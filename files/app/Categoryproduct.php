<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryproduct extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subcategory_id',
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

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function categoryproduct()
    {
        return $this->belongsTo('App\Categoryproduct');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
