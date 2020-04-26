@extends('layouts.app')

@section('content')
  <!-- Common Header Background Start -->
  @php
    $products = App\Cart::where('user_id', Auth::id())->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->get();
    $flag = 1;
  @endphp
  <!-- Common Header Background End -->
  <!-- container area Start -->
  <div class="container cart my-3">
    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{ __('Shopping Cart') }}</h2>
        <p>{{count($products)}} Items in cart</p>
      </div>
    </div>
    <!-- All Products -->
    @if(count($products) != 0)
    <div class="row mx-0 mt-3">
      <div class="col-md-9 px-1 mb-1">
        <table class="table table-striped table-hover border" width="100%">
          <thead class="bg-accent">
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total Price</th>
              <th>Action</th>
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
                <img class="mr-1" width="75" src='{{ asset("storage/$product->thumbnail_small") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
              </a></td>
              <td class="align-middle">
                <small id="resposne-{{ $cartProduct->id }}"></small>
                <input class="form-control" type="number" id="quantity-{{ $cartProduct->id }}" name="product_quantity" value="{{ $cartProduct->quantity }}">
              </td>
              <td class="align-middle">{{ $product->price }} BDT</td>
              <td class="align-middle" id="itemsPrice-{{$cartProduct->id}}">{{ round($cartProduct->quantity * $product->price) }} BDT</td>
              <td class="align-middle">
                <form action="{{route('deleteFromCartProduct')}}" method="post" class="d-inline">
                  @csrf
                  <button class="btn btn-danger" type="submit" name="product_id" value="{{$product->id}}" title="Remove from Cart">
                      <i class="far fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
            <!-- Ajax for item quantity update -->
            <script type="text/javascript">
              $(document).ready(function(){
                $("#quantity-{{ $cartProduct->id }}").change(function() {
                  var quantity = $(this).val();
                  var cart_id = {{ $cartProduct->id }};
                  var query_for = "cart_quantity_update";
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                    type:'POST',
                    url:'/AjaxPublic',
                    data: {query_for: query_for, quantity: quantity, cart_id: cart_id},
                    success: function (data) {
                      $( "#resposne-{{ $cartProduct->id }}" ).html(data.response);
                      $( "#itemsPrice-{{$cartProduct->id}}" ).html(data.price);
                      $( "#subTotal" ).html(data.total);
                    }
                  });
                });
              });
              </script>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-3 px-1 mb-1">
        @php
          $subTotal = array_sum($itemPrice);
        @endphp
        <div class="card-header bg-accent h5">Sub Total</div>
          <div class="card-body border" id="subTotal">
            {{ round($subTotal) }} BDT
          </div>
        </div>
      </div>
      @else
      <div class="row mx-0 mt-3">
        <div class="col-md-12 px-0 border">
          <div class="card text-center border-0 py-5">
            <h2>No Product in your Cart!</h2>
            <div class="card-body">
              <a class="btn btn-pico-lg" href="/store-directory">Back To Shop</a>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
@endsection
