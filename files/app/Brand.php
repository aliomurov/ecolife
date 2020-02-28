<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'image', 'brandcategory_id'
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

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function brandcategory()
    {
        return $this->belongsTo('App\Brandcategory');
    }
}
