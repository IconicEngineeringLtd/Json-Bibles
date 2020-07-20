@extends('layouts.app')

@section('content')
  <!-- container area Start -->
  <div class="container products my-3">
    <!-- First Row Start -->
    <div class="row bg-white mb-1">
      <!-- Header Categories area Start -->
      <div class="col-md-2 px-0 headerCategories d-none d-md-block">
        <ul>
          @foreach($categories as $category)
          <li class="mainCategory" title="{{ $category->name }}">
            <a href="{{route('categoryProduct', $category->url)}}">{{ Str::limit($category->name, 18, '...') }}</a>
            <ul class="subCategory">
              @foreach($category->subCategories as $subCategory)
                <li title="{{ $subCategory->name }}"><a href="{{route('subCategoryProduct', ['categoryUrl'=> $category->url, 'subCategoryUrl'=>$subCategory->url])}}" class="py-1">{{$subCategory->name}}</a></li>
              @endforeach
            </ul>
          </li>
          @endforeach
          <li><a href="{{route('storeDirectory')}}" class="font-weight-bold">Full Store Directory</a></li>
        </ul>
      </div>
      <!-- Header Categories area End -->
      <!-- Header Sliders Start -->
      <div class="col-md-10 px-0 headerSlider">
        <!-- Mobile Version -->
        <div class="mainSlider d-md-none d-block">
          @foreach($sliders as $slider)
            <img src='{{ asset("storage/$slider->thumbnail_small")}}'>
          @endforeach
        </div>
        <!-- PC Version -->
        <div class="mainSlider d-none d-md-block">
          @foreach($sliders as $slider)
            <img src='{{ asset("storage/$slider->image")}}'>
          @endforeach
        </div>
      </div>
      <!-- Header Sliders End -->
    </div>
    <!-- First Row End -->
    @php
      $productInfo = array("image" => "https://cdn.othoba.com/images/thumbs/0214584_discover-mens-fashion.jpeg", "name"=>"Mahadi Hasan", "price"=>"23,232");
    @endphp
    <!-- Top Products Start -->
    {{--<div class="row bg-white">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          <li><a href="#">Man</a></li>
          <li><a href="#">Women</a></li>
          <li><a href="#">Baby & Kids</a></li>
          <li><a href="#">Mobile</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 staticUnderSlider">
        @for ($i = 0; $i < 4; $i++)
          <div class="picture">
            <img class="card-img-top" src="{{ $productInfo['image'] }}" alt="Card image cap">
          </div>
        @endfor
      </div>
      <!-- Common Products Slider End -->
    </div>--}}
    <!-- Top Products End -->
    <!-- Recommended For You Start -->
    @if(count($popularProducts) >= 6)
    <div class="row-header">Popular Products</div>
    <div class="row bg-white">
      <!-- Common Products Slider Start -->
      <div class="col-md-12 px-0 commonProductSlider">
        <div class="row mx-0 productSliderManual">
          @foreach($popularProducts as $popularProduct)
          @php
            $popularProduct = $popularProduct->productInfo;
          @endphp
          <div class="col-md-2 px-1">
            <a href="{{ route('product_details', $popularProduct->url) }}" class="card">
              <img class="card-img-top" src='{{ asset("storage/$popularProduct->thumbnail_medium") }}' title="{{ $popularProduct->title }}" alt="{{ $popularProduct->title }}">
              <div class="card-body">
                <h6 class="card-title text-muted">{{ Str::limit($popularProduct->title, 25, '..') }}</h6>
                <p class="text-dark">BDT {{ $popularProduct->price }}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    @endif
    <!-- Recommended For You End -->
    <div class="devider mb-5"></div>
    <!-- Calibration Start -->
    @php
      $categoryInfo = $categories->find(1);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white my-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(1)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(1)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(1)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($calibration as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Calibration End -->
    <div class="devider mb-5"></div>
    <!-- HVAC/Clean Rooms Start -->
    @php
      $categoryInfo = $categories->find(2);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(2)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(2)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(2)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($hvac as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- HVAC/Clean Rooms End -->
    <div class="devider mb-5"></div>
    <!-- Electrical Start -->
    @php
      $categoryInfo = $categories->find(3);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(3)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(3)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(3)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($electrical as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Electrical End -->
    <div class="devider mb-5"></div>
    <!-- Temperature Start -->
    @php
      $categoryInfo = $categories->find(4);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(4)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(4)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(4)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($temperature as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Temperature End -->
    <div class="devider mb-5"></div>
    <!-- Energy & Environmental Start -->
    @php
      $categoryInfo = $categories->find(5);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(5)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(5)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(5)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($energy as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Energy & Environmental End -->
    <div class="devider mb-5"></div>
    <!-- Mechanical & Maintenance Start -->
    @php
      $categoryInfo = $categories->find(6);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(6)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(6)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(6)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($mechanical as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Mechanical & Maintenance End -->
    <div class="devider mb-5"></div>
    <!-- Pharma, Health & Biomedical Start -->
    @php
      $categoryInfo = $categories->find(7);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(7)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(7)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(7)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($pharma as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Pharma, Health & Biomedical End -->
    <div class="devider mb-5"></div>
    <!-- Networking Start -->
    @php
      $categoryInfo = $categories->find(8);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(8)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(8)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(8)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($networking as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Networking End -->
    <div class="devider mb-5"></div>
    <!-- Transformer Testing Start -->
    @php
      $categoryInfo = $categories->find(9);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(9)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(9)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(9)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($transformer as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Transformer Testing End -->
    <div class="devider mb-5"></div>
    <!-- Power, Resistance and Battery Start -->
    @php
      $categoryInfo = $categories->find(10);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(10)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(10)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(10)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($insulation as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Power, Resistance and Battery End -->
    <div class="devider mb-5"></div>
    <!-- Fault Testing & Diagnostics Start -->
    @php
      $categoryInfo = $categories->find(11);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(11)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(11)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(11)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($fault as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Fault Testing & Diagnostics End -->
    <div class="devider mb-5"></div>
    <!-- Lightning Protection Solution Start -->
    @php
      $categoryInfo = $categories->find(12);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(12)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(12)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(12)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($lps as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Lightning Protection Solution End -->
    <div class="devider mb-5"></div>
    <!-- Education, Research & Development Start -->
    @php
      $categoryInfo = $categories->find(13);
    @endphp
    @if(!empty($categoryInfo->banner))<a href="{{route('categoryProduct', $categoryInfo->url)}}" class="row-img-header d-block"><img src='{{asset("/storage/$categoryInfo->banner")}}' alt="{{$categoryInfo->name}}" title="{{$categoryInfo->name}}"></a>@endif
    <div class="row-block-header">{{$categoryInfo->name}}</div>
    <div class="row bg-white mt-2">
      <!-- Common Categories Start -->
      <div class="col-md-2 px-0 commonCategories d-none d-md-block">
        <ul>
          @foreach($categories->find(13)->subCategories->take(9) as $sub_category)
            <li><a href="{{route('subCategoryProduct', ['categoryUrl'=> $categories->find(13)->url, 'subCategoryUrl'=>$sub_category->url])}}" title="{{$sub_category->name}}">{{Str::limit($sub_category->name, 20, '..')}}</a></li>
          @endforeach
          <li><a href="{{route('categoryProduct', $categories->find(13)->url)}}" class="font-weight-bold">View All</a></li>
        </ul>
      </div>
      <!-- Common Categories End -->
      <!-- Common Products Slider Start -->
      <div class="col-md-10 px-0 commonProductSlider">
        <div class="row mx-0 productSlider">
          @foreach($education as $product)
            <div class="col-md-3 px-1 mb-2">
              <a href="{{ route('product_details', $product->url) }}" class="card">
                <img class="card-img-top" src='{{ asset("storage/$product->thumbnail_medium") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
                <div class="card-body">
                  <h6 class="card-title text-muted">{{ Str::limit($product->title, 25, '..') }}</h6>
                  <p class="text-dark font-weight-bold">BDT {{ $product->price }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Common Products Slider End -->
    </div>
    <!-- Education, Research & Development End -->
  </div>
  <!-- container Section End -->
@endsection
