<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularProducts extends Model
{
    protected $fillable = ['view_counter'];

    public function productInfo()
    {
      return $this->belongsTo('App\Products', 'product_id')->select('title','url','price','thumbnail_medium');
    }
}
