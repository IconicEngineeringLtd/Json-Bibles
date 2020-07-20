@extends('layouts.app')

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{$curBrand->name}}</h2>
      </div>
    </div>
    <!-- All Products -->
    <div class="row">
      <div class="col-md-2 mt-3 filter">
        <h5>Filter by Category</h5>
        <ul class="filterMainList">
          @forelse($curBrand->products->unique('category_id') as $product)
          <li><a href="{{route('subCategoriesByBrandCategory', ['brandUrl' => $curBrand->url, 'categoryUrl' => $product->category->url])}}">{{ $product->category->name }}</a></li>
          @empty
            No Categories
          @endforelse
        </ul>
      </div>
      <div class="col-md-10">
        <div class="row mx-0 mt-3">
          @forelse($curBrand->products->unique('sub_category_id') as $product)
          <div class="col-md-3 px-1 mb-2">
            <a href="{{route('productsByBrandCategorySubCategory', ['brandUrl' => $curBrand->url, 'categoryUrl' => $product->category->url, 'subCategoryUrl' => $product->sub_category->url])}}" class="card">
              <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->sub_category->name }}" alt="{{ $product->sub_category->name }}">
              <div class="card-body">
                <h6 class="card-title text-center text-muted">{{ Str::limit($product->sub_category->name, 25, '..') }}</h6>
              </div>
            </a>
          </div>
          @empty
            No sub category found!
          @endforelse
      </div>
    </div>
  </div>
@endsection
