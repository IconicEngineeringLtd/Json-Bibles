<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Cart;
use Session;

class CartController extends Controller
{
  // View products in Cart
  public function cartProductsView()
  {
    $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
    $cart = new Cart($oldCart);
    $products = $cart->items;
    $totalQty = $cart->totalQty;
    $totalPrice = $cart->totalPrice;
    return view('frontend.shop.cart', compact('products', 'totalQty', 'totalPrice'));
  }

  // Product Add to Cart
  public function addCartProduct(Request $request)
  {
    $product = Products::findOrFail($request->product_id);
    $oldCart = Session::has('cart') ? Session::get('cart') : NULL;

    $cart = new Cart($oldCart);
    $cart->add($product, $product->id);
    $request->session()->put('cart', $cart);

    // dd($request->session()->get('cart'));
    return back()->with('status', 'Successfully Added to Cart!');
  }

  // Update Cart by Ajax Request
  public function updateCart(Request $request)
  {
    // Verify request for Minus & Update by New Entry
    if ($request->query_for == "cartQtyMinus") {
        $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
        $cart = new Cart($oldCart);
        $cart->cartReduce($request->product_id, $request->qtyValue);
        $request->session()->put('cart', $cart);

      // Send Response to View
      return response()->json([
        'response' => "Cart Updated Successfully!",
        'currentUnitQty' => $cart->items[$request->product_id]['qty'],
        'currentUnitPrice' => $cart->items[$request->product_id]['price'] . " BDT",
        'currentTotalQty' => $cart->totalQty,
        'currentTotalPrice' => round($cart->totalPrice) . " BDT",
      ]);
    }
    // Verify request for Plus & Update by New Entry
    if ($request->query_for == "cartQtyPlus"){
        $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
        $cart = new Cart($oldCart);
        $cart->cartIncrease($request->product_id, $request->qtyValue);
        $request->session()->put('cart', $cart);

      // Send Response to View
      return response()->json([
        'response' => "Cart Updated Successfully!",
        'currentUnitQty' => $cart->items[$request->product_id]['qty'],
        'currentUnitPrice' => $cart->items[$request->product_id]['price'] . " BDT",
        'currentTotalQty' => $cart->totalQty,
        'currentTotalPrice' => round($cart->totalPrice) . " BDT",
      ]);
    }
    // Verify request for Plus & Update by New Entry
    if ($request->query_for == "cartQtyToggle"){
        $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
        $cart = new Cart($oldCart);
        $cart->cartToggle($request->product_id, $request->qtyValue);
        $request->session()->put('cart', $cart);

      // Send Response to View
      return response()->json([
        'response' => "Cart Updated Successfully!",
        'currentUnitQty' => $cart->items[$request->product_id]['qty'],
        'currentUnitPrice' => $cart->items[$request->product_id]['price'] . " BDT",
        'currentTotalQty' => $cart->totalQty,
        'currentTotalPrice' => round($cart->totalPrice) . " BDT",
      ]);
    }
  }
  public function cartProductRemove($productId)
  {
    // Check Cart Availablity
    $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
    // Send Data to Cart Model
    $cart = new Cart($oldCart);
    $cart->cartItemDelete($productId);
    session()->put('cart', $cart);
    // Send Data to View
    $products = $cart->items;
    $totalQty = $cart->totalQty;
    $totalPrice = $cart->totalPrice;
    // Destroy cart if empty
    if ($totalQty == 0) {
      session()->forget('cart', $cart);
    }
    return back();
  }
}
