<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brandcategory extends Model
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

    public function brand()
    {
        return $this->hasMany('App\Brand');
    }
}
