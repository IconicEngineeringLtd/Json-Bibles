<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
  protected $fillable = ['name', 'url', 'meta_title', 'meta_slug', 'meta_description', 'meta_keywords'];

  public function category()
  {
    return $this->belongsToMany('App\Categories', 'cat_subs', 'sub_category_id', 'category_id');
  }
  public function products()
  {
    return $this->hasMany('App\Products', 'sub_category_id');
  }
}
