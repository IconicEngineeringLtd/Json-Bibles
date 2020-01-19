<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['updated_by', 'supplier_id', 'category_id', 'sub_category_id', 'brand_id', 'model', 'title', 'url', 'price', 'discount_ratio', 'overview', 'features', 'specifications', 'includes', 'accessories', 'meta_title', 'meta_slug', 'meta_description', 'meta_keywords', 'tags', 'product_image', 'thumbnail_small', 'thumbnail_medium'];

    //Relationship
    public function store()
    {
      return $this->belongsTo('App\Stores', 'supplier_id');
    }
    public function brand()
    {
      return $this->belongsTo('App\Brands');
    }
    public function category()
    {
      return $this->belongsTo('App\Categories');
    }
    public function sub_category()
    {
      return $this->belongsTo('App\SubCategories');
    }
    public function inventory()
    {
      return $this->hasMany('App\Inventories', 'product_id');
    }
}
