@extends('layouts.app')

@section('content')
<div class="offerPageBGC">
  <div class="pageHeader">
    <h1 class="title">Summer Hot Deals</h1>
  </div>
  <!-- Container Start -->
  <div class="container my-5 py-5">
    <div class="row">
      <a href="{{ route('uiOfferCategory') }}" class="col-6 col-md-3">
        <div class="offerIndexBox">
          <div class="tag animatedGradient">Live</div>
          <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/6002da3351d7-88445858_190191588976553_5517111419876671488_n.png" alt="">
        </div>
      </a>
      <a href="{{ route('uiOfferCategory') }}" class="col-6 col-md-3">
        <div class="offerIndexBox">
          <div class="tag animatedGradient">Live</div>
          <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/461ce49332d9-88236454_193062391978835_956460736891060224_n.png" alt="">
        </div>
      </a>
    </div>
  </div>
</div>
@endsection
