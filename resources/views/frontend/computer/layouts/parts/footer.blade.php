<footer class="footer">
  <!-- container area Start -->
  <div class="container">
    <!-- Footer Start -->
    <div class="row">

      <div class="col-md-6">
        <div class="media mb-3">
          <i class="fas fa-headset fooHeadset mr-3"></i>
          <div class="media-body">
            <small class="mt-0 d-block">Any Question? Call us !</small>
            <span class="fooNumber d-block">+88 01977426640</span>
          </div>
        </div>
        <h4>Contact Info</h4>
        <p>Plot-7, Main Road-3, Section-7, Pallabi, Mirpur, Dhaka-1216</p>
        <div class="fooSocial">
          <a class="facebook" href="//facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a class="twitter" href="//twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
          <a class="pinterest" href="//pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
          <a class="linkedin" href="//linkedin.com/company/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
          <a class="medium" href="//medium.com/@" target="_blank"><i class="fab fa-medium-m"></i></a>
        </div>
      </div>
      <div class="col-md-2">
        <div class="header">Customer Care</div>
        <ul>
          <li><a href="#">Help Center</a></li>
          <li><a href="#">How to Buy</a></li>
          <li><a href="#">Track Your Order</a></li>
          <li><a href="#">Returns & Refunds</a></li>
          <li><a href="{{route('contact')}}">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <div class="header">About Us</div>
        <ul>
          <li><a href="{{route('about')}}">About Tools</a></li>
          <li><a href="#">News</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <div class="header">My Account</div>
        <ul>
          <li><a href="{{ route('login') }}">My Account</a></li>
          <li><a href="{{route('favoriteProductsView')}}">Favorites</a></li>
          <li><a href="{{route('cartProductsView')}}">Shopping Cart</a></li>
          <li><a href="#">Orders</a></li>
          <li><a href="#">Manage Your Content & Devices</a></li>
        </ul>
      </div>
    </div>
    <!-- Footer End -->
  </div>
  <!-- container area End -->
</footer>

<!-- Copy Right Area -->
<div class="container">
  <div class="copyright-body">
    <p class="float-left">&copy; {{date('Y')}} www.tools.com.bd</p>
    <ul class="float-right">
      <li><a href="#">Sitemap</a></li>
      <li><a href="#">Terms of Use</a></li>
      <li><a href="#">Privacy Policy</a></li>
    </ul>
  </div>
</div>
