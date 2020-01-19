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
          <a href="{{route('supplierAllProducts', ['storeId' => $store->id, 'subCategoryId'=>$product->sub_category->id])}}" class="card">
            <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->sub_category->name }}" alt="{{ $product->sub_category->name }}">
            <div class="card-body">
              <h6 class="card-title text-center text-muted">{{ Str::limit($product->sub_category->name, 25, '..') }}</h6>
            </div>
          </a>
        </div>
      @empty
        No categories found!
      @endforelse
    </div>
  </div>

@endsection
