<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Added by Jayed Hasan
use Auth;
use Carbon\Carbon;
use Session;
use App\Http\Controllers\GetInfo;

use App\Brands;
use App\Categories;
use App\Products;
use App\PopularProducts;
use App\Viewed;
// use App\Wishlist;
// Added by Jayed Hasan
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
      return view('frontend.computer.shop.storeDirectory', compact('headinfos', 'totalProducts', 'brands', 'categories'));
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
      $metaInformations = array(
        'title' => $product->title,
        'meta_title' => $product->meta_title,
        'og_title' => $product->meta_title,
        'twitter_title' => $product->meta_title,
        'meta_description' => $product->meta_description,
        'og_description' => $product->meta_description,
        'twitter_description' => $product->meta_description,
        'meta_keywords' => $product->meta_keywords,
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
      return view('frontend.computer.shop.productDetails', compact('metaInformations', 'schema', 'metaImage', 'product', 'cartStatus', 'viewedProducts'));
    }
}
