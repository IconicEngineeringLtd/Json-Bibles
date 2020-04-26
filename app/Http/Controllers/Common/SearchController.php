<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Added by Jayed Hasan
use App\Products;
// Added by Jayed Hasan

class SearchController extends Controller
{
    // Search Related Methods
    public function searchResult(Request $request)
    {
      $keyword = $request->keyword;
      $products = Products::where('model', 'like', "%$keyword%")->orwhere('title', 'like', "%$keyword%")->orwhere('overview', 'like', "%$keyword%")->get();
      return view("frontend.computer.search.result", compact('products'));
    }
}
