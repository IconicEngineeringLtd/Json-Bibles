@extends('layouts.app')

@section('content')
<div class="offerPageBGC">
  <div class="pageHeaderImage mt-2 mb-5">
    <div class="container">
      <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/f1b9af58c137-88261185_1892380894229025_3459949009966202880_n.png" alt="">
      <h3 class="shortDescription">Xiaomi for Freedom Flash Sale 30% Discount</h3>
    </div>
  </div>
  <!-- Container Start -->
  <div class="container mb-5">
    <div class="row">
      <a href="{{ route('uiOfferDetails') }}" class="col-6 col-md-3">
        <div class="offerIndexBox">
          <span class="tag animatedGradient">Live</span>
          <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/6002da3351d7-88445858_190191588976553_5517111419876671488_n.png" alt="">
        </div>
      </a>
      <a href="{{ route('uiOfferDetails') }}" class="col-6 col-md-3">
        <div class="offerIndexBox">
          <span class="tag animatedGradient">Live</span>
          <img src="https://s3-ap-southeast-1.amazonaws.com/media.evaly.com.bd/media/images/461ce49332d9-88236454_193062391978835_956460736891060224_n.png" alt="">
        </div>
      </a>
    </div>
  </div>
</div>
@endsection
