<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    function owner()
    {
      return $this->belongsTo('App\User');
    }
    function admins()
    {
      return $this->belongsToMany('App\User', 'roles_stores', 'user_id', 'store_id');
    }
    function products()
    {
      return $this->hasMany('App\Products', 'supplier_id');
    }
    public function categories()
    {
        return $this->hasManyThrough('App\Categories', 'App\Products', 'supplier_id', 'id');
    }
    function tags()
    {
      return $this->hasMany('App\Tags', 'store_id');
    }
}
