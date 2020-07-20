@extends('layouts.app')

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <div class="row">
      <div class="col-md-12 px-1">
        <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
          <!-- Header Background Image -->
          <div class="headerBgInfo">
            <h2>{{count($products)}} Results</h2>
          </div>
        </div>
        <!-- All Products -->
        <div class="row mx-0 mt-3">
          @foreach($products as $product)
          <div class="col-md-2 px-1 mb-2">
            <a href="{{ route('product_details', $product->url) }}" class="card">
              <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{$product->title}}" alt="{{$product->title}}">
              <div class="card-body">
                <h6 class="card-title text-muted">{{ Str::limit($product->title, 20, '..') }}</h6>
                <p class="text-dark">BDT {{ $product->price }}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
