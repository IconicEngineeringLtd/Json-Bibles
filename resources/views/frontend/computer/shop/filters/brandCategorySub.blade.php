@extends('frontend.computer.layouts.frame')

@section('metaInformations')
  @if(isset($metaInformations))
    <title>{{ $metaInformations['title'] }} - {{ config('app.name') }}</title>
    <meta name="meta_title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="meta_description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="meta_keywords" content="{{ $metaInformations['meta_keywords'] }}">
    <meta name="title" content="{{ $metaInformations['meta_title'] }}">
    <meta property="og:title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="twitter:title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="description" content="{{ $metaInformations['meta_description'] }}">
    <meta property="og:description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="twitter:description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="keywords" content="{{ $metaInformations['meta_keywords'] }}">
  @else
    <title>Products by Brand, Category and Sub Category - {{ config('app.name', 'Tools.com.bd') }}</title>
  @endif
@endsection

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{$subCategory->name}}</h2>
      </div>
    </div>
    <!-- All Products -->
    <div class="row">
      <div class="col-md-2 mt-3 filter">
        <h5>Filter by Sub Category</h5>
        <ul class="filterMainList">
          @forelse($subCategories->unique('sub_category_id') as $product)
          <li><a href="{{route('productsByBrandCategorySubCategory', ['brandUrl' => $product->brand->url, 'categoryUrl' => $product->category->url, 'subCategoryUrl' => $product->sub_category->url])}}">{{ $product->sub_category->name }}</a></li>
          @empty
            No Categories
          @endforelse
        </ul>
      </div>
      <div class="col-md-10">
        <div class="row mx-0 mt-3">
        @forelse($products as $product)
        <div class="col-md-3 px-1 mb-2">
          <a href="{{ route('product_details', $product->url) }}" class="card">
            <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
            <div class="card-body">
              <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
              <p class="text-dark">BDT {{ $product->price }}</p>
            </div>
          </a>
        </div>
        @empty
          No products found!
        @endforelse
      </div>
    </div>
  </div>
@endsection
