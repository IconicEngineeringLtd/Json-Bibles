<div class="topbar">
  <div class="container">
    <ul class="ul-right">
      <li class="facebook d-none"><a href="//facebook.com/IconicEngineering" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
      <li class="twitter d-none"><a href="//twitter.com/IconicEngrLtd" target="_blank"><i class="fab fa-twitter"></i></a></li>
      <li class="pinterest d-none"><a href="//pinterest.com/IconicEngineeringLimited" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
      <li class="linkedin d-none"><a href="//linkedin.com/company/iconicengineering" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
      <li class="medium d-none"><a href="//medium.com/@iconicengineeringltd" target="_blank"><i class="fab fa-medium-m"></i></a></li>
      <li class="email d-none"><a href="mailto:info@pico.com.bd">info@tools.com.bd</a></li>
      @auth
        <li class="signup"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;{{ __('Dashboard') }}</a></li>
      @endauth
      @guest
      <li class="signin"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
        @if (Route::has('register'))
          <li class="signup"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
        @endif
      @else
      <li class="nav-item dropdown userinfo">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->username }} <span class="caret"></span>
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
      @endguest
    </ul>
  </div>
</div>
