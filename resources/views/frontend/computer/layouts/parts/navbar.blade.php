<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <h2 class="text-uppercase">{{ __('Tools') }}</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <form class="form" action="{{ route('searchResult') }}" method="GET">
                  <div class="input-group navbarSearch">
                    <input type="text" class="form-control" name="keyword" placeholder="Search for Tools" aria-label="Search for Tools" aria-describedby="search">
                    <div class="input-group-append">
                      <button class="btn bg-accent" type="submit" id="search"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </li>
              <li class="nav-item cartIcon">
                <a href="{{route('storeDirectory')}}" title="Store Directory"><i class="fas fa-store"></i></a>
              </li>
              <li class="nav-item cartIcon">
                <a href="{{route('cartProductsView')}}" id="cart-badge">
                  @if(Session::has('cart'))
                    <i class="fas fa-shopping-cart"></i><span class="value_counter">{{ Session::get('cart')->totalQty }}</span>
                  @else
                    <i class="fas fa-cart-arrow-down"></i>
                  @endif
                </a>
              </li>
              <li class="nav-item favoriteIcon">
                <a href="{{route('favoriteProductsView')}}" id="favorite-badge">
                  @if(App\Wishlists::where('user_id', Auth::id())->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->exists())
                    <i class="fas fa-heart"></i><span class="value_counter">{{App\Wishlists::where('user_id', Auth::id())->orWhere('ipAddress', $_SERVER['REMOTE_ADDR'])->count()}}</span>
                  @else
                    <i class="far fa-heart"></i>
                  @endif
                </a>
              </li>
                {{--<!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest--}}
            </ul>
        </div>
    </div>
</nav>
