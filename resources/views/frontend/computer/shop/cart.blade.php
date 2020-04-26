@extends('layouts.app')

@section('content')

  <!-- container area Start -->
  <div class="container cart my-3">

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

    <div class="headerBackground" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/background-images/photo-1489537235181-fc05daed5805.jfif')}})">
      <!-- Header Background Image -->
      <div class="headerBgInfo">
        <h2>{{ __('Shopping Cart') }}</h2>
      </div>
    </div>
    <!-- All Products -->
    @if($totalQty != 0)
    <div class="row mx-0 mt-3">
      <div class="col-md-9 px-1 mb-1">
        <table class="table table-striped table-hover border text-center" width="100%">
          <thead class="bg-accent">
            <tr>
              <th>Title</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td class="align-middle"><a class="media pt-2 pr-1" href="{{ route('product_details', $product['item']->url) }}" target="_blank">
                @php
                  $imgSrc = $product['item']->thumbnail_small;
                @endphp
                <img class="mr-1 align-center" width="75" src="{{ asset("storage/$imgSrc") }}" title="{{ $product['item']->title }}" alt="{{ $product['item']->title }}">
              </a></td>
              <td class="align-middle">
                <div class="qtyController">
                  <button type="button" id="qtyMinus{{ $product['item']->id }}" class="btn minus">-</button>
                  <input type="text" id="currentUnitQty{{ $product['item']->id }}" class="form-control" value="{{ $product['qty'] }}">
                  <button type="button" id="qtyPlus{{ $product['item']->id }}" class="btn plus">+</button>
                </div>
                <!-- Ajax Request for qtyController Start -->
                <script type="text/javascript">
                  $(document).ready(function(){
                    // Codes for Minus
                    $("#qtyMinus{{ $product['item']->id }}").click(function() {
                      var qtyValue = $("#qtyValue{{ $product['item']->id }}").val();
                      var product_id = "{{ $product['item']->id }}";
                      var query_for = "cartQtyMinus";
                      $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                      $.ajax({
                        type:'POST',
                        url:'/ajaxCartController',
                        data: {query_for: query_for, qtyValue: qtyValue, product_id: product_id},
                        success: function (data) {
                          $( "#currentUnitQty{{ $product['item']->id }}" ).val(data.currentUnitQty);
                          $( "#currentUnitPrice{{ $product['item']->id }}" ).html(data.currentUnitPrice);
                          $( "#currentTotalQty" ).html(data.currentTotalQty);
                          $( "#currentTotalPrice" ).html(data.currentTotalPrice);
                          $( "#grandTotal" ).html(data.currentTotalPrice);
                        }
                      });
                    });
                    // Codes for Plus
                    $("#qtyPlus{{ $product['item']->id }}").click(function() {
                      var qtyValue = $("#qtyValue{{ $product['item']->id }}").val();
                      var product_id = "{{ $product['item']->id }}";
                      var query_for = "cartQtyPlus";
                      $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                      $.ajax({
                        type:'POST',
                        url:'/ajaxCartController',
                        data: {query_for: query_for, qtyValue: qtyValue, product_id: product_id},
                        success: function (data) {
                          $( "#currentUnitQty{{ $product['item']->id }}" ).val(data.currentUnitQty);
                          $( "#currentUnitPrice{{ $product['item']->id }}" ).html(data.currentUnitPrice);
                          $( "#currentTotalQty" ).html(data.currentTotalQty);
                          $( "#currentTotalPrice" ).html(data.currentTotalPrice);
                          $( "#grandTotal" ).html(data.currentTotalPrice);
                        }
                      });
                    });
                    // Codes for Toggle Action
                    $("#currentUnitQty{{ $product['item']->id }}").keyup(function() {
                      var qtyValue = $(this).val();
                      var product_id = "{{ $product['item']->id }}";
                      var query_for = "cartQtyToggle";
                      $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                      $.ajax({
                        type:'POST',
                        url:'/ajaxCartController',
                        data: {query_for: query_for, qtyValue: qtyValue, product_id: product_id},
                        success: function (data) {
                          $( "#currentUnitQty{{ $product['item']->id }}" ).val(data.currentUnitQty);
                          $( "#currentUnitPrice{{ $product['item']->id }}" ).html(data.currentUnitPrice);
                          $( "#currentTotalQty" ).html(data.currentTotalQty);
                          $( "#currentTotalPrice" ).html(data.currentTotalPrice);
                          $( "#grandTotal" ).html(data.currentTotalPrice);
                        }
                      });
                    });
                  });
                </script>
                <!-- Ajax Request for qtyController Start -->
              </td>
              <td class="align-middle">{{ $product['item']->price }} BDT</td>
              <td class="align-middle" id="currentUnitPrice{{ $product['item']->id }}">{{ $product['price'] }} BDT</td>
              <td class="align-middle">
                <a href="{{route('cartProductRemove', $product['item']->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
            <tr>
              <td class="text-right font-weight-bold">Total Quantity:</td>
              <td class="text-center font-weight-bold" id="currentTotalQty">{{ round($totalQty) }}</td>
              <td class="text-right font-weight-bold">Sub Total:</td>
              <td class="text-center font-weight-bold" id="currentTotalPrice">{{ round($totalPrice) }} BDT</td>
              <td class="text-center font-weight-bold"></td>
            </tr>
          </tbody>
        </table>
        </div>
        <div class="col-md-3 px-1 mb-1">
          <div class="card-header bg-accent h5">Grand Total</div>
          <div class="card-body border" id="grandTotal">
            {{ round($totalPrice) }} BDT
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
