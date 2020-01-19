@extends('supplier.store.storeFrame')

@section('storeContents')

  <div class="stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif

    <div class="row">
      @if(!empty($store))
        <div class="col-md-4 p-0 px-1 mb-1">
          <a href="{{ route('innerStore', $store->id) }}" class="store">
            <i class="fas fa-store"></i>
            <p>{{ $store->name }}</p>
          </a>
        </div>
      @else
      <div class="col-md-4 p-0 px-1 mb-1">
        <a href="{{ route('supplierStoreAdd') }}" class="store">
          <i class="fas fa-plus-circle"></i>
          <p>New Store</p>
        </a>
      </div>
      @endif
    </div>
    <div class="row">
      @if(count(Auth::user()->assignedStores) != 0)
      @foreach(Auth::user()->assignedStores as $store)
        <div class="col-md-4 p-0 px-1 mb-1">
          <a href="{{ route('innerStore', $store->id) }}" class="store">
            <i class="fas fa-store"></i>
            <p>{{ $store->name }}</p>
          </a>
        </div>
      @endforeach
      @else
        <p>No Assigned Store</p>
      @endif
    </div>
  </div>

@endsection
