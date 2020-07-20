<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Sliders;
use App\Categories;
use App\SubCategories;
use App\Products;
use App\PopularProducts;

class UiWelcomeController extends Controller
{
  // Home Page Methods
  public function welcome()
  {
    $reqData = ['title','url','price','thumbnail_medium'];
    // Categories
    $sliders = Sliders::where('privacy', 1)->get();
    $categories = Categories::select('id','name','url','banner')->get();
    // Products
    $popularProducts = PopularProducts::orderBy('view_counter', 'desc')->take(6)->get();
    $calibration = Products::where('category_id', 1)->inRandomOrder()->select($reqData)->take(5)->get();
    $hvac = Products::where('category_id', 2)->inRandomOrder()->select($reqData)->take(5)->get();
    $electrical = Products::where('category_id', 3)->inRandomOrder()->select($reqData)->take(5)->get();
    $temperature = Products::where('category_id', 4)->inRandomOrder()->select($reqData)->take(5)->get();
    $energy = Products::where('category_id', 5)->inRandomOrder()->select($reqData)->take(5)->get();
    $mechanical = Products::where('category_id', 6)->inRandomOrder()->select($reqData)->take(5)->get();
    $pharma = Products::where('category_id', 7)->inRandomOrder()->select($reqData)->take(5)->get();
    $networking = Products::where('category_id', 8)->inRandomOrder()->select($reqData)->take(5)->get();
    $transformer = Products::where('category_id', 9)->inRandomOrder()->select($reqData)->take(5)->get();
    $insulation = Products::where('category_id', 10)->inRandomOrder()->select($reqData)->take(5)->get();
    $fault = Products::where('category_id', 11)->inRandomOrder()->select($reqData)->take(5)->get();
    $lps = Products::where('category_id', 12)->inRandomOrder()->select($reqData)->take(5)->get();
    $education = Products::where('category_id', 13)->inRandomOrder()->select($reqData)->take(5)->get();

    // Head informations for seo start
    $headinfos = array(
      'title' => '<title>'.config('app.name').'</title>',
      'meta_title' => '<meta name="title" content="'.config('app.name').'">',
      // 'meta_description' => '<meta name="description" content="">',
      // 'meta_keywords' => '<meta name="keyword" content="">',
    );
    // Head informations for seo end

    return view('frontend.welcome', compact('headinfos','sliders', 'categories', 'popularProducts', 'calibration', 'hvac', 'electrical', 'temperature', 'energy', 'mechanical', 'pharma', 'networking', 'transformer', 'insulation', 'fault', 'lps', 'education'));
  }

}
