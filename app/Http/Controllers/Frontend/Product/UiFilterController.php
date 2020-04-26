<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Added by Jayed Hasan
use App\Brands;
use App\Categories;
use App\SubCategories;
use App\Products;
// Added by Jayed Hasan

class UiFilterController extends Controller
{
  // Categories by Brand
  public function categoriesByBrand($brandUrl)
  {
    $curBrand = Brands::where('url', $brandUrl)->first();

    // Meta informations for SEO start
    $metaInformations = array(
      'title' => $curBrand->name,
      'meta_title' => $curBrand->meta_title,
      'meta_description' => $curBrand->meta_description,
      'meta_keywords' => $curBrand->meta_keywords,
      'og_title' => $curBrand->meta_title,
      'twitter_title' => $curBrand->meta_title,
      'og_description' => $curBrand->meta_description,
      'twitter_description' => $curBrand->meta_description,
    );
    // Meta informations for SEO end
    return view('frontend.computer.shop.filters.brand', compact('metaInformations', 'curBrand'));
  }
  // Sub Categories by Brand & Category
  public function subCategoriesByBrandCategory($brandUrl, $categoryUrl)
  {
    $brand = Brands::where('url', $brandUrl)->first();
    $curCategory = Categories::where('url', $categoryUrl)->first();
    $products = Products::where('brand_id', $brand->id)->where('category_id', $curCategory->id)->get();

    // Meta informations for SEO start
    $metaInformations = array(
      'title' => $brand->name . ' ' . $curCategory->name,
      'meta_title' => $brand->name . ' ' . $curCategory->meta_title,
      'meta_description' => $curCategory->meta_description,
      'meta_keywords' => $curCategory->meta_keywords,
      'og_title' => $curCategory->meta_title,
      'twitter_title' => $curCategory->meta_title,
      'og_description' => $curCategory->meta_description,
      'twitter_description' => $curCategory->meta_description,
    );
    // Meta informations for SEO end
    return view('frontend.computer.shop.filters.brandCategory', compact('metaInformations', 'brand', 'curCategory', 'products'));
  }
  // Products by Brand, Category & Sub Category
  public function productsByBrandCategorySubCategory($brandUrl, $categoryUrl, $subCategoryUrl)
  {
    $brand = Brands::where('url', $brandUrl)->first();
    $category = Categories::where('url', $categoryUrl)->first();
    $subCategory = SubCategories::where('url', $subCategoryUrl)->first();
    $products = Products::where('brand_id', $brand->id)->where('category_id', $category->id)->where('sub_category_id', $subCategory->id)->get();
    $subCategories = Products::where('brand_id', $brand->id)->where('category_id', $category->id)->get();

    // Meta informations for SEO start
    $metaInformations = array(
      'title' => $brand->name . ' ' . $subCategory->name,
      'meta_title' => $brand->name . ' ' . $subCategory->meta_title,
      'meta_description' => $subCategory->meta_description,
      'meta_keywords' => $subCategory->meta_keywords,
      'og_title' => $brand->name . ' ' . $subCategory->meta_title,
      'twitter_title' => $brand->name . ' ' . $subCategory->meta_title,
      'og_description' => $subCategory->meta_description,
      'twitter_description' => $subCategory->meta_description,
    );
    // Meta informations for SEO end
    return view('frontend.computer.shop.filters.brandCategorySub', compact('metaInformations', 'brand', 'category', 'subCategory', 'products', 'subCategories'));
  }

  // Product with Sub Category Page Methods
  public function subCategoryProduct($categoryUrl, $subCategoryUrl)
  {
    $category = Categories::where('url', $categoryUrl)->first();
    $sub_category = SubCategories::where('url', $subCategoryUrl)->first();
    // Head informations for seo start
    $headinfos = array(
      'title' => '<title>'. $category->name ."-". $sub_category->name .' - ' .config('app.name').'</title>',
      'meta_title' => '<meta name="title" content="'. $category->name ."-". $sub_category->meta_title .' - ' .config('app.name').'">',
      'meta_description' => '<meta name="description" content="'. $sub_category->meta_description .'">',
      'meta_keywords' => '<meta name="keyword" content="'. $sub_category->meta_keywords .'">',
      'og_title' => '<meta property="og:title" content="'. $category->name ."-". $sub_category->meta_title .' - ' .config('app.name').'">',
      'twitter_title' => '<meta name="twitter:title" content="'. $category->name ."-". $sub_category->meta_title .' - ' .config('app.name').'">',
      'og_description' => '<meta property="og:description" content="'. $sub_category->meta_description .'">',
      'twitter_description' => '<meta name="twitter:description" content="'. $sub_category->meta_description .'">',
    );
    // Head informations for seo end
    return view('frontend.computer.shop.subcategories', compact('headinfos', 'sub_category'));
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
