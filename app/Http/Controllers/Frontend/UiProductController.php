<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Brands;
use App\Categories;
use App\Products;

class UiProductController extends Controller
{
    /*=======================================================
        Show all
    =======================================================*/
    public function storeDirectory()
    {
      $totalProducts = Products::count();
      $categories = Categories::select('id', 'name', 'url')->get();
      $brands = Brands::select('name', 'url')->get();
      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>Store Directory - '.config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="Store Directory - '.config('app.name').'">',
        // 'meta_description' => '<meta name="description" content="">',
        // 'meta_keywords' => '<meta name="keyword" content="">',
      );
      // Head informations for seo end
      return view('frontend.shop.storeDirectory', compact('headinfos', 'totalProducts', 'brands', 'categories'));
    }


    /*=======================================================
        Show products by category from product table
    =======================================================*/
    public function productsByCategory($categoryUrl)
    {
      $category = Categories::where('url', $categoryUrl)->first();
      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>'. $category->name .' - ' .config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="'. $category->meta_title .' - ' .config('app.name').'">',
        'meta_description' => '<meta name="description" content="'. $category->meta_description .'">',
        'meta_keywords' => '<meta name="keyword" content="'. $category->meta_keywords .'">',
        'og_title' => '<meta property="og:title" content="'. $category->meta_title .' - ' .config('app.name').'">',
        'twitter_title' => '<meta name="twitter:title" content="'. $category->meta_title .' - ' .config('app.name').'">',
        'og_description' => '<meta property="og:description" content="'. $category->meta_description .'">',
        'twitter_description' => '<meta name="twitter:description" content="'. $category->meta_description .'">',
      );
      // Head informations for seo end
      return view('frontend.shop.categories', compact('headinfos', 'category'));
    }
}
