@extends('layouts.app')

@section('content')

  <!-- Common Header Background Start -->
  @php
    $products = App\Wishlists::where('user_id', Auth::id())->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->get();
    $flag = 1;
  @endphp
  <!-- Common Header Background End -->
  <!-- container area Start -->
  <div class="container cart my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{ __('My Favorites') }}</h2>
        <p>{{count($products)}} Items in My Favorites</p>
      </div>
    </div>
    <!-- All Products -->
    @if(count($products) != 0)
    <div class="row mx-0 mt-3">
      <div class="col-md-9 px-1 mb-1">
        <!-- Server Response start -->
        @if (session('status'))
          <div class="alert alert-success" role="alert" id="alert">
            {{ session('status') }}
          </div>
        @endif
        @if (session('warning'))
          <div class="alert alert-danger" role="alert" id="alert">
            {{ session('warning') }}
          </div>
        @endif
        <!-- Server Response end -->
        <table class="table table-striped table-hover border" width="100%">
          <thead class="bg-accent">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $cartProduct)
              @php
                $product = $cartProduct->productInfo;
                $itemPrice[] = $cartProduct->quantity * $product->price;
              @endphp
            <tr>
              <td class="align-middle" scope="row">{{$flag++}}</td>
              <td class="align-middle"><a class="media pt-2 pr-1" href="{{ route('product_details', $product->url) }}" target="_blank">
                <img class="mr-1" width="50" src='{{ asset("storage/$product->thumbnail_small") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
              </a></td>
              <td class="align-middle">{{$product->title}}</td>
              <td class="align-middle">
                <form action="{{route('moveToCartProduct')}}" method="post" class="d-inline">
                  @csrf
                  <button class="btn btn-success" type="submit" name="product_id" value="{{$product->id}}" title="Add to Cart">
                      <i class="fas fa-cart-arrow-down"></i>
                  </button>
                </form>
                <form action="{{route('deleteFromFavoriteProduct')}}" method="post" class="d-inline">
                  @csrf
                  <button class="btn btn-danger" type="submit" name="product_id" value="{{$product->id}}" title="Remove from Favorite">
                      <i class="far fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-3 px-1 mb-1">
        <div class="card-header bg-accent h5">Actions</div>
          <div class="card-body border">

          </div>
        </div>
      </div>
      @else
      <div class="row mx-0 mt-3">
        <div class="col-md-12 px-0 border">
          <div class="card text-center border-0 py-5">
            <h2>No Product in Favorite List!</h2>
            <div class="card-body">
              <a class="btn btn-pico-lg" href="/">Back To Home</a>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
@endsection
