@extends('supplier.store.innerStore.frame')

@section('storeContents')

  <div class="storeAdd stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">Total Products: {{count($store->products)}}</h2>
      <div class="row mx-0 mt-3">
      @forelse($store->categories as $category)
        <div class="col-md-3 px-1 mb-2">
          <a href="{{route('supplierAllSubCategories', ['storeId' => $store->id, 'categoryId' => $category->id])}}" class="card">
            @foreach($category->products->take(1) as $product)
              <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $category->name }}" alt="{{ $category->name }}">
            @endforeach
            <div class="card-body">
              <h6 class="card-title text-center text-muted">{{ Str::limit($category->name, 25, '..') }}</h6>
            </div>
          </a>
        </div>
      @empty
        No categories found!
      @endforelse
    </div>
  </div>

@endsection
