@extends('supplier.store.innerStore.frame')

@section('storeContents')

  <div class="storeAdd stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">{{$store->name}}</h2>
  </div>

@endsection
