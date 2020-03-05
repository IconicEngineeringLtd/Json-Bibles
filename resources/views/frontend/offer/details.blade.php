@extends('layouts.app')

@section('content')
<div class="offerPageBGC">
  <div class="offerProductDetails">
    <div class="container my-5">
      <div class="row">
        <div class="offerPageElement col-md-9">
          <div class="row">
            <div class="col-md-6">
              <img class="card-img-top" src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/5ad3bb580d20-xiaomi-redmi-8a-smartphone-622-2-gb-ram-32-gb-rom-12-mp-camera-matte-black-1.jpg" alt="">
            </div>
            <div class="col-md-6">
              <h1 class="productTitle">Xiaomi Redmi 8A Smartphone - 6.22" - 2 GB Ram - 32 GB Rom - 12 MP Camera Matte Black</h1>
              <span class="d-block">SKU: 0X44494</span>
              <a class="d-block" href="#">BRAND : Fluke</a>
              <p class="mt-2">
                Navigation & Positioning<br>
                • GPS<br>
                • Galileo<br>
                • Beidou<br>
                • GLONASS
              </p>
            </div>
          </div>
        </div>
        <div class="offerPageElement col-md-3">
          <h1 class="productTitle">Xiaomi Redmi 8A Smartphone - 6.22" - 2 GB Ram - 32 GB Rom - 12 MP Camera Matte Black</h1>
          <span class="d-block">SKU: 0X44494</span>
          <a class="d-block" href="#">BRAND : Fluke</a>
          <p class="mt-2">
            Navigation & Positioning<br>
            • GPS<br>
            • Galileo<br>
            • Beidou<br>
            • GLONASS
          </p>
        </div>
      </div>
    </div>
    <!-- Container Start -->
    <div class="container mb-5">
      <h4 class="">Related Products</h4>
      <div class="row offerPageElement py-3">
        @for($i=1;$i<=6;$i++)
        <a href="{{ route('uiOfferDetails') }}" class="col-6 col-md-2">
          <div class="offerIndexBox">
            <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/5ad3bb580d20-xiaomi-redmi-8a-smartphone-622-2-gb-ram-32-gb-rom-12-mp-camera-matte-black-1.jpg" alt="">
            <h3 class="relatedProductTitle">Xiaomi Redmi 8A Smartphone</h3>
          </div>
        </a>
        @endfor
      </div>
    </div>
  </div>
</div>
@endsection
