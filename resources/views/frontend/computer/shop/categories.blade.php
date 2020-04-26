@extends('layouts.app')

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{ $category->name }}</h2>
        <p>{{count($category->products)}} Products</p>
      </div>
    </div>
    <!-- All Products -->
    <div class="row mx-0 mt-3">
      @if(count($category->subCategories) != 0)
        @foreach($category->subCategories as $subCategory)
          <div class="col-md-2 px-1 mb-2">
            <a href="{{route('subCategoryProduct', ['categoryUrl'=> $category->url, 'subCategoryUrl'=>$subCategory->url])}}" class="card">
              @foreach($subCategory->products->take(1) as $product)
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $subCategory->name }}" alt="{{ $subCategory->name }}">
              @endforeach
              <div class="card-body">
                <h6 class="card-title text-center text-muted">{{ Str::limit($subCategory->name, 25, '..') }}</h6>
              </div>
            </a>
          </div>
        @endforeach
      @else
        No products found!
      @endif
    </div>
  </div>
@endsection
