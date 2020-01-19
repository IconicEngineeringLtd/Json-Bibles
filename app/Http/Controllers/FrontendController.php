<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GetInfo;
use Auth;
use Carbon\Carbon;
// Mail
use App\Mail\MessageSent;
use Mail;
use Session;

use App\Sliders;
use App\Brands;
use App\Products;
use App\Categories;
use App\SubCategories;
use App\Cart;
use App\PopularProducts;
use App\Viewed;
use App\Wishlist;
// use Artisan;
class FrontendController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // Artisan Comands
        // Artisan::call('storage:link');
        // Artisan::call('cache:clear');
        // Artisan::call('route:clear');
        // Artisan::call('config:clear');
        // Artisan::call('view:clear');
        // Artisan::call('optimize:clear');
    }
    // Ajax Requests Start
    public function ajaxPublic(Request $request)
    {
      // Cart Quantity Update
      if ($request->query_for == "cart_quantity_update") {
        // Check quantity value
        if($request->quantity > 0){
          Cart::find($request->cart_id)->update([
            "quantity" => $request->quantity,
          ]);
        }else{
          Cart::find($request->cart_id)->update([
            "quantity" => 1,
          ]);
        }
        // Data sending to view
        // Single item
        $currentProduct = Cart::findOrFail($request->cart_id);
        $price = $currentProduct->productInfo->price * $currentProduct->quantity;
        // All item start
        $products = Cart::where('user_id', Auth::id())->orWhere('ipAddress', GetInfo::ip())->get();
        foreach($products as $cartProduct){
          $product = $cartProduct->productInfo;
          $itemPrice[] = $cartProduct->quantity * $product->price;
        }
        $subTotal = array_sum($itemPrice);
        // All item end
        return response()->json([
            'response' => "Cart Updated Successfully!",
            'price' => round($price) .  " BDT",
            'total' => round($subTotal) .  " BDT",
        ]);
      }

    }
    // Ajax Requests End

    // Search Related Methods
    public function searchProducts()
    {
      $keyword = $_GET['keyword'];
      $products = Products::where('model', 'like', "%$keyword%")->orwhere('title', 'like', "%$keyword%")->orwhere('overview', 'like', "%$keyword%")->get();
      return view("frontend.shop.searchResult", compact('products'));
    }


    
    // Categories by Brand
    public function categoriesByBrand($brandUrl)
    {
      $curBrand = Brands::where('url', $brandUrl)->first();

      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>'. $curBrand->name .' - ' .config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="'. $curBrand->meta_title .' - ' .config('app.name').'">',
        'meta_description' => '<meta name="description" content="'. $curBrand->meta_description .'">',
        'meta_keywords' => '<meta name="keyword" content="'. $curBrand->meta_keywords .'">',
        'og_title' => '<meta property="og:title" content="'.$curBrand->meta_title.'">',
        'twitter_title' => '<meta name="twitter:title" content="'.$curBrand->meta_title.'">',
        'og_description' => '<meta property="og:description" content="'.$curBrand->meta_description.'">',
        'twitter_description' => '<meta name="twitter:description" content="'.$curBrand->meta_description.'">',
      );
      // Head informations for seo end
      return view('frontend.shop.filters.brand', compact('headinfos', 'curBrand'));
    }
    // Sub Categories by Brand & Category
    public function subCategoriesByBrandCategory($brandUrl, $categoryUrl)
    {
      $brand = Brands::where('url', $brandUrl)->first();
      $curCategory = Categories::where('url', $categoryUrl)->first();
      $products = Products::where('brand_id', $brand->id)->where('category_id', $curCategory->id)->get();

      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>'. $brand->name ."\n". $curCategory->name .' - ' .config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="'. $brand->name ."\n". $curCategory->meta_title .' - ' .config('app.name').'">',
        'meta_description' => '<meta name="description" content="'. $curCategory->meta_description .'">',
        'meta_keywords' => '<meta name="keyword" content="'. $curCategory->meta_keywords .'">',
        'og_title' => '<meta property="og:title" content="'. $curCategory->meta_title .' - ' .config('app.name').'">',
        'twitter_title' => '<meta name="twitter:title" content="'. $curCategory->meta_title .' - ' .config('app.name').'">',
        'og_description' => '<meta property="og:description" content="'. $curCategory->meta_description .'">',
        'twitter_description' => '<meta name="twitter:description" content="'. $curCategory->meta_description .'">',
      );
      // Head informations for seo end
      return view('frontend.shop.filters.brandCategory', compact('headinfos', 'brand', 'curCategory', 'products'));
    }
    // Products by Brand, Category & Sub Category
    public function productsByBrandCategorySubCategory($brandUrl, $categoryUrl, $subCategoryUrl)
    {
      $brand = Brands::where('url', $brandUrl)->first();
      $category = Categories::where('url', $categoryUrl)->first();
      $subCategory = SubCategories::where('url', $subCategoryUrl)->first();
      $products = Products::where('brand_id', $brand->id)->where('category_id', $category->id)->where('sub_category_id', $subCategory->id)->get();
      $subCategories = Products::where('brand_id', $brand->id)->where('category_id', $category->id)->get();

      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>'. $brand->name ."\n". $category->name ."-". $subCategory->name .' - ' .config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="'. $brand->name ."\n". $category->name ."-". $subCategory->meta_title .' - ' .config('app.name').'">',
        'meta_description' => '<meta name="description" content="'. $subCategory->meta_description .'">',
        'meta_keywords' => '<meta name="keyword" content="'. $subCategory->meta_keywords .'">',
        'og_title' => '<meta property="og:title" content="'. $brand->name ."\n". $category->name ."-". $subCategory->meta_title .' - ' .config('app.name').'">',
        'twitter_title' => '<meta name="twitter:title" content="'. $brand->name ."\n". $category->name ."-". $subCategory->meta_title .' - ' .config('app.name').'">',
        'og_description' => '<meta property="og:description" content="'. $subCategory->meta_description .'">',
        'twitter_description' => '<meta name="twitter:description" content="'. $subCategory->meta_description .'">',
      );
      // Head informations for seo end
      return view('frontend.shop.filters.brandCategorySub', compact('headinfos', 'brand', 'category', 'subCategory', 'products', 'subCategories'));
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
      return view('frontend.shop.subcategories', compact('headinfos', 'sub_category'));
    }
    // Single Product Page Methods
    public function productDetails(Request $request, $productUrl)
    {
      $product = Products::where('url', $productUrl)->first();

      /* ==========================================================
          Working with Session Start
      ========================================================== */
        // Viewed products list generator
        $oldViewed = Session::has('viewed') ? Session::get('viewed') : NULL;
        // Create an Object of Viewed Class & Pass Value
        $viewed = new Viewed($oldViewed);
        $viewed->add($product, $product->id);
        // Put new entry
        $request->session()->put('viewed', $viewed);
        // Passing value to View
        $viewedProducts = $viewed->products;
        // dd($request->session()->get('viewed'));
      /* ==========================================================
          Working with Session End
      ========================================================== */

      // Popular products list generator
      if(PopularProducts::where('product_id', $product->id)->exists()){
        if(PopularProducts::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->exists()){
          // Increment unique view_counter value at every revisit to same product.
          $entry = PopularProducts::where('product_id', $product->id)->first();
          PopularProducts::find($entry->id)->update([
            "view_counter" => $entry->view_counter + 1,
          ]);
        }
      }else {
        // Add visit history to database at the first visit to any product.
        PopularProducts::insert([
          "product_id" => $product->id,
          "user_id" => Auth::id(),
          "ipAddress" => GetInfo::ip(),
          "created_at" => Carbon::now(),
        ]);
      }

      // Cart Check
      if (Session::has('cart')) {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (array_key_exists($product->id, $cart->items)) {
          $cartStatus = 1;
        }else {
          $cartStatus = 0;
        }
      }else{
        $cartStatus = 0;
      }
      // Head informations for seo start
      $metaImage = $product->product_image;
      $headinfos = array(
        'title' => '<title>'.$product->title.' - ' .config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="'.$product->meta_title.' - ' .config('app.name').'">',
        'og_title' => '<meta property="og:title" content="'.$product->meta_title.' - ' .config('app.name').'">',
        'twitter_title' => '<meta name="twitter:title" content="'.$product->meta_title.' - ' .config('app.name').'">',
        'meta_description' => '<meta name="description" content="'.$product->meta_description.'">',
        'og_description' => '<meta property="og:description" content="'.$product->meta_description.'">',
        'twitter_description' => '<meta name="twitter:description" content="'.$product->meta_description.'">',
        'meta_keywords' => '<meta name="keywords" content="'.$product->meta_keywords.'">',
      );
      // Head informations for seo end
      // Schema Marcup Start
      $schema = '<script type="application/ld+json">
      {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "'.$product->title.'",
        "image": [
          "'.asset("/storage/$product->product_image").'"
         ],
        "description": "'.strip_tags(str_replace('"', '', $product->overview)).'",
        "sku": "NULL",
        "mpn": "NULL",
        "brand": {
          "@type": "Thing",
          "name": "'.$product->brand->name.'"
        },
        "review": {
          "@type": "Review",
          "reviewRating": {
            "@type": "Rating",
            "ratingValue": "'.'0'.'",
            "bestRating": "'.'0'.'"
          },
          "author": {
            "@type": "Organization",
            "name": "'. 'NULL' .'"
          }
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "'.'0'.'",
          "reviewCount": "'.'0'.'"
        },
        "offers": {
          "@type": "Offer",
          "url": "NULL",
          "priceCurrency": "BDT",
          "price": "0",
          "priceValidUntil": "NULL",
          "itemCondition": "NULL",
          "availability": "InStock",
          "seller": {
            "@type": "Organization",
            "name": "'. config('app.name') .'"
          }
        }
      }
      </script>';
      // Schema Marcup End
      return view('frontend.shop.product_details', compact('headinfos', 'schema', 'metaImage', 'product', 'cartStatus', 'viewedProducts'));
    }
    // Product Add to Cart
    public function addCartProduct(Request $request)
    {
      $product = Products::findOrFail($request->product_id);
      // Viewed products list generator
      if(Cart::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->exists()){
        $entry = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->first();
        if($request->quantity > 0){
          Cart::find($entry->id)->update([
            "quantity" => $request->quantity,
            "supplier_id" => $product->store->id,
          ]);
          return back()->with('status', 'Cart Updated Successfully!');
        }else{
          Cart::find($entry->id)->update([
            "quantity" => 1,
            "supplier_id" => $product->store->id,
          ]);
          return back()->with('status', 'Cart Updated Successfully!');
        }
      }else {
        if($request->quantity > 0){
          Cart::insert([
            "user_id" => Auth::id(),
            "ipAddress" => GetInfo::ip(),
            "product_id" => $product->id,
            "quantity" => $request->quantity,
            "supplier_id" => $product->store->id,
            "created_at" => Carbon::now(),
          ]);
          return back()->with('status', 'Successfully Added to Cart!');
        }else{
          return back()->with('warning', 'Quantity must be 1 or greater!');
        }
      }
    }
    // Product Add to Favorite
    public function addFavoriteProduct(Request $request)
    {
      $product = Products::findOrFail($request->product_id);
      // Viewed products list generator
      if(Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->exists()){
        return back()->with('status', 'Already Added to Favorite!');
      }else {
        Wishlist::insert([
          "product_id" => $product->id,
          "user_id" => Auth::id(),
          "ipAddress" => GetInfo::ip(),
          "created_at" => Carbon::now(),
        ]);
        return back()->with('status', 'Successfully Added to Favorite!');
      }
    }
    public function favoriteProductsView()
    {
      return view('frontend.shop.favorite');
    }
    // Move to Cart
    public function moveToCartProduct(Request $request)
    {
      $product = Products::findOrFail($request->product_id);
      // Viewed products list generator
      if(Cart::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->exists()){
        return back()->with('warning', 'This product already in your Cart!');
      }else {
        Cart::insert([
          "user_id" => Auth::id(),
          "ipAddress" => GetInfo::ip(),
          "product_id" => $product->id,
          "quantity" => 1,
          "supplier_id" => $product->store->id,
          "created_at" => Carbon::now(),
        ]);
        Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $product->id)->delete();
        return back()->with('status', 'Successfully Added to Cart & Removed from Favorite List!');
      }
    }
    public function deleteFromFavoriteProduct(Request $request)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $request->product_id)->orWhere('ipAddress', GetInfo::ip())->where('product_id', $request->product_id)->delete();
        return back()->with('status', 'Successfully removed from Favorite List!');
    }

    // About Page Methods
    public function about()
    {
      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>About - '.config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="About - '.config('app.name').'">',
        // 'meta_description' => '<meta name="description" content="">',
        // 'meta_keywords' => '<meta name="keyword" content="">',
      );
      // Head informations for seo end
      return view('frontend.about', compact('headinfos'));
    }

    // Contact Page Methods
    public function contact()
    {
      // Head informations for seo start
      $headinfos = array(
        'title' => '<title>Contact - '.config('app.name').'</title>',
        'meta_title' => '<meta name="title" content="Contact - '.config('app.name').'">',
        // 'meta_description' => '<meta name="description" content="">',
        // 'meta_keywords' => '<meta name="keyword" content="">',
      );
      // Head informations for seo end
      return view('frontend.contact', compact('headinfos'));
    }
    public function contactSendMessage(Request $request)
    {
      Mail::to('jayed.iconic@gmail.com')
            ->cc('archive.iconic@gmail.com')
            ->bcc('jayedhasan232@gmail.com')
            ->send(new MessageSent($request));

      return back()->with('status', 'Message Successfully Sent!');
    }
}
