@extends('supplier.store.innerStore.frame')

@section('storeContents')

  <div class="storeAdd stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">Browse Products by Category</h2>
      <div class="row mx-0 mt-3">
      @forelse($products as $product)
        <div class="col-md-3 px-1 mb-2">
          <a href="{{ route('product_details', $product->url) }}" class="card" target="_blank">
            <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
            <div class="card-body">
              <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
              <p class="text-dark">BDT {{ $product->price }}</p>
            </div>
          </a>
        </div>
      @empty
        No categories found!
      @endforelse
    </div>
  </div>

@endsection
