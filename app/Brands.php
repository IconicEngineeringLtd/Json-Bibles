<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    public function products()
    {
      return $this->hasMany('App\Products', 'brand_id');
    }
    public function categories()
    {
        return $this->hasManyThrough('App\Categories', 'App\Products', 'brand_id', 'id');
    }
    public function subCategories()
    {
        return $this->hasManyThrough('App\SubCategories', 'App\Products', 'brand_id', 'id');
    }
}
