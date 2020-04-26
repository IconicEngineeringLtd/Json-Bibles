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
      return view('frontend.computer.shop.favorite');
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
      return view('frontend.computer.about', compact('headinfos'));
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
      return view('frontend.computer.contact', compact('headinfos'));
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
