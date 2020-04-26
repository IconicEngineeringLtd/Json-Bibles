@extends('frontend.computer.layouts.frame')

@section('metaInformations')
  @if(isset($metaInformations))
    <title>{{ $product->title }} - {{ config('app.name') }}</title>
    <meta name="meta_title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="meta_description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="meta_keywords" content="{{ $metaInformations['meta_keywords'] }}">
    <meta name="title" content="{{ $metaInformations['meta_title'] }}">
    <meta property="og:title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="twitter:title" content="{{ $metaInformations['meta_title'] }}">
    <meta name="description" content="{{ $metaInformations['meta_description'] }}">
    <meta property="og:description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="twitter:description" content="{{ $metaInformations['meta_description'] }}">
    <meta name="keywords" content="{{ $metaInformations['meta_keywords'] }}">
  @else
    <title>Product details - {{ config('app.name', 'Tools.com.bd') }}</title>
  @endif
@endsection

@section('content')
  <div class="container products singleProduct">
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

    <div class="row">
      <div class="col-md-9 mainContents">
        <!-- Product Show Start -->
        <div class="row productShow">
          <div class="col-md-6 leftSide">
            <div class="mainImage">
              <img src='{{ asset("storage/$product->product_image") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
              @if(App\Wishlists::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->where('product_id', $product->id)->exists())
                <span class="lovedIcon"><i class="fas fa-heart"></i></span>
              @else
                <span class="loveIcon"><i class="fas fa-heart"></i></span>
              @endif
            </div>
            <div class="imageGallery">
              <img  src='{{ asset("storage/$product->thumbnail_small") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
            </div>
          </div>
          <div class="col-md-6 rightSide">
            <h1 class="h4">{{$product->title}}</h1>
            <p>Supplier: <strong>{{ucwords($product->store->name)}}</strong></p>
            <p>Brand: <a href="{{route('categoriesByBrand', $product->brand->url)}}" class="text-accent"><strong>{{ucwords($product->brand->name)}}</strong></a></p>
            <p>Category: <a href="{{route('subCategoriesByBrandCategory', ['brandUrl' => $product->brand->url, 'categoryUrl' => $product->category->url])}}" class="text-accent"><strong>{{ucwords($product->category->name)}}</strong></a></p>
            <p>Sub Category: <a href="{{route('productsByBrandCategorySubCategory', ['brandUrl' => $product->brand->url, 'categoryUrl' => $product->category->url, 'subCategoryUrl' => $product->sub_category->url])}}" class="text-accent"><strong>{{ucwords($product->sub_category->name)}}</strong></a></p>
            @if(count($product->inventory) != 0)
              <p class="d-block">In Stock: <strong class="text-accent">{{ $product->inventory->sum('quantity') }}</strong></p>
            @else
              <strong class="d-block text-danger">Out of Stock</strong>
            @endif
            <!-- Pricing -->
            @if($product->price != 0)
              @if($product->discount_ratio != 0)
                @php
                  $discountAmount = $product->price / $product->discount_ratio;
                  $offerPrice = $product->price - $discountAmount;
                @endphp
                <del>Regular Price: {{$product->price}} ৳</del><span class="text-danger"> - {{$product->discount_ratio}}% Off</span>
                <p class="text-accent font-weight-bold">Offer Price: {{$offerPrice}} ৳</p>
              @else
                <p>Price: <span class="text-accent font-weight-bold">{{$product->price}} ৳</span></p>
              @endif
            @else
              <a href="#" class="text-accent font-weight-bold" title="Ask the Supplier">Ask for Price</a>
            @endif

            <form action="{{route('addCartProduct')}}" method="post" class="d-block mt-2">
              @csrf
              <button class="btn bg-accent" type="submit" name="product_id" value="{{$product->id}}">
                @if($cartStatus == 1)
                  <i class="fas fa-cart-plus"></i> Added to Cart
                @else
                  <i class="fas fa-cart-plus"></i> Add to Cart
                @endif
              </button>
            </form>
            <!-- Add to cart end -->
            <!-- Add to favorite start -->
            <form action="{{route('addFavoriteProduct')}}" method="post" class="d-block mt-1">
              @csrf
              <button class="btn bg-accent" type="submit" name="product_id" value="{{$product->id}}">
                @if(App\Wishlists::where('user_id', Auth::id())->where('product_id', $product->id)->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->where('product_id', $product->id)->exists())
                  <i class="far fa-heart"></i> Added to Favorite
                @else
                  <i class="far fa-heart"></i> Add to Favorite
                @endif
              </button>
            </form>
            <!-- Add to favorite end -->

            <!-- Auth Options start -->
            @auth
              @if(!empty(Auth::user()->myStore) && Auth::user()->myStore->id == $product->store->id || Auth::user()->role == 1)
                <!-- Product Sold & Stock, Only Store Owner Can See This Options-->
                <div class="border mt-5 p-1" title="Only Store owner can see this section.">
                  @if(count($product->inventory) != 0) <p class="d-block">Last Update: <strong class="text-accent"> {{ $product->inventory->last()->created_at->diffForHumans() }} </strong></p> @endif
                  <a href="{{route('supplierEditProduct', $product->id)}}" class="mt-1 d-block"><i class="fas fa-edit"></i> Edit This Product</a>

                  <button class="btn bg-accent mt-1 d-block" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-shopping-basket"></i> Manage Inventory</button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <form action="{{ route('storeInventoryIncrease') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                          <div class="modal-header bg-accent">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{$product->title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body">
                            <label for="basic-url">Increase your Stock!</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Current Stock: {{ $product->inventory->sum('quantity') }}</span>
                              </div>
                              <input type="text" class="form-control" name="quantity" aria-describedby="basic-addon3">
                              <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                              <input type="hidden" class="form-control" name="supplier_id" value="{{$product->store->id}}">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-accent">Add Now</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endif
            @endauth

            <!-- Auth Options end -->
          </div>
        </div>
        <!-- Product Show End -->
        <!-- Product Info Start -->
        <div class="row">
          <div class="productInfo">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
                <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-controls="nav-reviews" aria-selected="false">Reviews</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                <p>{!! str_replace("<a","<a class='bb-green-2'", "$product->overview") !!}</p>
              </div>
              <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                <div class="accordion" id="accordionProductInfo">
                  <div>
                    <div id="headingFeatures" class="acctabbox">
                      <h4 class="collapsed text-accent pointer" data-toggle="collapse" data-target="#Features" aria-expanded="false" aria-controls="Features">Features</h4>
                    </div>
                    <div id="Features" class="collapse show pl-4" aria-labelledby="headingFeatures" data-parent="#accordionProductInfo">
                      @if($product->features != NULL)
                        {!! $product->features !!}
                      @endif
                    </div>
                  </div>
                  <div>
                    <div id="headingSpecifications" class="acctabbox">
                      <h4 class="collapsed text-accent pointer" data-toggle="collapse" data-target="#Specifications" aria-expanded="false" aria-controls="Specifications">Specifications</h4>
                    </div>
                    <div id="Specifications" class="collapse pt-2" aria-labelledby="headingSpecifications" data-parent="#accordionProductInfo">
                      <div class="card-text">@if(isset($product->specifications)) {!! str_replace(array("<table","</table>"), array("<div class='table-responsive'><table class='table'", "</table></div>"), $product->specifications) !!} @else No Records! @endif</div>
                    </div>
                  </div>
                  <div>
                    <div id="headingIncludes" class="acctabbox">
                      <h4 class="collapsed text-accent pointer" data-toggle="collapse" data-target="#Includes" aria-expanded="false" aria-controls="Includes">Includes</h4>
                    </div>
                    <div id="Includes" class="collapse pl-4" aria-labelledby="headingIncludes" data-parent="#accordionProductInfo">
                      @if($product->includes != NULL)
                        {!! $product->includes !!}
                      @endif
                    </div>
                  </div>
                  <div>
                    <div id="headingAccessories" class="acctabbox">
                      <h4 class="collapsed text-accent pointer" data-toggle="collapse" data-target="#Accessories" aria-expanded="false" aria-controls="Accessories">Accessories</h4>
                    </div>
                    <div id="Accessories" class="collapse pl-4" aria-labelledby="headingAccessories" data-parent="#accordionProductInfo">
                      @if($product->accessories != NULL)
                        {!! $product->accessories !!}
                      @endif
                    </div>
                  </div>
                  <div>
                    <div id="headingResources" class="acctabbox">
                      <h4 class="collapsed text-accent pointer" data-toggle="collapse" data-target="#Resources" aria-expanded="false" aria-controls="Resources">Resources</h4>
                    </div>
                    <div id="Resources" class="collapse pl-4" aria-labelledby="headingResources" data-parent="#accordionProductInfo">
                      @if($product->resources != NULL)
                        {!! $product->resources !!}
                      @else
                        No Records
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
                <div class="productReview">
                  <!-- Rating start -->
                  <!-- User/Visitor Comments Section Start -->
                    <div class="card-body">
                      <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="rating" class="mr-2">Your Rating:</label>
                          <div class="star-rating text-center">
                            @for($rate = 5; $rate >= 1; $rate--)
                            <input id="star-{{$rate}}" type="radio" name="rating" value="{{$rate}}">
                            <label for="star-{{$rate}}" title="{{$rate}}">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            @endfor
                          </div>
                        </div>

                        @auth
                        <div class="form-group">
                          <textarea class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="content" placeholder="Hi {{ Auth::user()->name }}, please insert your review." required></textarea>
                          @if ($errors->has('content'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                          <input type="hidden" name="name" value="{{ Auth::id() }}">
                          <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                          <input type="hidden" name="relative_id" value="0">
                        </div>
                        @endauth
                        @guest
                        <div class="form-group">
                          <textarea class="form-control" onfocus="getgeoLocation()" name="content" placeholder="Please insert your review." required></textarea>
                          @if ($errors->has('content'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="inputCity">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Insert your name." required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputState">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Insert your email." required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputZip">Website</label>
                            <input type="text" class="form-control" name="website" placeholder="Insert your website.">
                          </div>
                        </div>
                        <input type="hidden" name="relative_id" value="0">
                        <input type="hidden" name="latitude" id="lati" value="">
                        <input type="hidden" name="longitude" id="longi" value="">
                        {{--<div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                              Save my name, email, and website in this browser for the next time I comment.
                            </label>
                          </div>
                        </div>--}}

                        <script>
                          function getgeoLocation()
                          {
                            if (navigator.geolocation) {
                              navigator.geolocation.getCurrentPosition(showPosition);
                            }

                            function showPosition(position) {
                              document.getElementById("lati").value = position.coords.latitude;
                              document.getElementById("longi").value = position.coords.longitude;
                            }
                          }
                        </script>
                        @endguest
                        <button type="submit" class="btn bg-accent text-white">Submit</button>
                      </form>
                    </div>
                  <!-- Rating end -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product Info End -->

        <!-- Recommended For You Start -->
        @if(count($viewedProducts) > 1)
        <!-- PC Version -->
        <div class="relatedProducts d-none d-md-block">
          <h5 class="header">Products you viewed</h5>
          <div class="row <?php echo(count($viewedProducts) >= 5)?'productSlider':'';?>">
            @foreach($viewedProducts as $viewedproduct)
            <div class="col-md-3 px-1 mb-1">
              <a href="{{ route('product_details', $viewedproduct->url) }}" class="card text-dark">
                <img class="card-img-top" src='{{ asset("storage/$viewedproduct->thumbnail_medium")}}' title="{{$viewedproduct->title}}" alt="{{$viewedproduct->title}}">
                <div class="card-body">
                  <h5 class="card-title">{{Str::limit($viewedproduct->title, 15, '..')}}</h5>
                  <p class="card-text">BDT {{$viewedproduct->price}}</p>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
        @endif
        <!-- Recommended For You End -->
      </div>
      <div class="col-md-3 sidebar">
        <div class="sponsored d-none">
          Sponsored Ad.
        </div>
        <div class="suggestProducts">
          <div class="header">You may like</div>
          @foreach($product->category->products->take(8) as $product)
          <a class="media pt-2 pr-1" href="{{ route('product_details', $product->url) }}">
            <img class="mr-1" src='{{ asset("storage/$product->thumbnail_small") }}' title="{{ $product->title }}" alt="{{ $product->title }}">
            <div class="media-body">
              <h6 class="mt-0 text-accent">{{ Str::limit($product->title, 20, '..') }}</h6>
              <p>{{Str::limit(strip_tags($product->overview), 40, '..')}}</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
