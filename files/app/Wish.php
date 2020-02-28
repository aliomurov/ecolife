<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'ip_address'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
