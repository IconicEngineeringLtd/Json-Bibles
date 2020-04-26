@extends('frontend.computer.layouts.frame')

@section('metaInformations')
  @if(isset($metaInformations))
    <title>Store Directory - {{ config('app.name') }}</title>
    <meta name="meta_title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="meta_description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="meta_keywords" content="{{ $metaInformations['meta_keywords'] }}">
  @else
    <title>Store Directory - {{ config('app.name', 'Tools.com.bd') }}</title>
  @endif
@endsection

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>Store Directory</h2>
        <p>{{$totalProducts}} Products</p>
      </div>
    </div>
    <!-- All Products -->
    <div class="row">
      <div class="col-md-2 mt-3 filter">
        <h5>Filter by Brand</h5>
        <ul class="filterMainList">
          @forelse($brands as $brand)
          <li><a href="{{route('categoriesByBrand', $brand->url)}}">{{$brand->name}}</a></li>
          @empty
            No Brands
          @endforelse
        </ul>
      </div>
      <div class="col-md-10">
        <div class="row mx-0 mt-3">
          @forelse($categories as $category)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{route('categoryProduct', $category->url)}}" class="card">
                @foreach($category->products->take(1) as $product)
                  <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $category->name }}" alt="{{ $category->name }}">
                @endforeach
                <div class="card-body">
                  <h6 class="card-title text-center text-muted">{{ Str::limit($category->name, 25, '..') }}</h6>
                </div>
              </a>
            </div>
            @empty
            No products found!
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
