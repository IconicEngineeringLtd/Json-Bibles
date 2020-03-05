<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Sliders;

class OfferController extends Controller
{
    // Offer Page Methods
    public function uiOfferIndex()
    {
      return view('frontend.offer.index');
    }
    // Offer Category Page Methods
    public function uiOfferCategory()
    {
      return view('frontend.offer.category');
    }
    // Offer Details Page Methods
    public function uiOfferDetails()
    {
      return view('frontend.offer.details');
    }
}
