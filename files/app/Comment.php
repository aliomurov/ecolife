<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'email', 'product_id', 'subject'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
