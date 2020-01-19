<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name', 'url', 'meta_title', 'meta_slug', 'meta_description', 'meta_keywords', 'banner', 'banner_privacy', 'cover', 'cover_privacy'];

    public function subCategories()
    {
      return $this->belongsToMany('App\SubCategories', 'cat_subs', 'category_id', 'sub_category_id');
    }

    public function products()
    {
      return $this->hasMany('App\Products', 'category_id')->select('id', 'title', 'url', 'overview', 'thumbnail_medium', 'thumbnail_small');
    }
}
