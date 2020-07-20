<footer class="footer">
  <!-- container area Start -->
  <div class="container">
    <!-- Footer Start -->
    <div class="row">

      <div class="col-md-6">
        <div class="header">Contact Us</div>
        <ul class="d-block">
          <li><i class="fas fa-map-marker-alt mr-2"></i></i>Bikrampur Tower, 137 Nawabpur, Dhaka-1100 Bangladesh</li>
          <li><i class="fas fa-phone-volume mr-2"></i><a class="mb-3" href="tel:+8801631790043">+8801631790043</a></li>
          <li><i class="fas fa-envelope mr-2"></i><a class="mb-3" href="mailto:info@tools.com.bd">info@tools.com.bd</a></li>
        </ul>
        <div class="fooSocial mt-3">
          <ul>
            <li><a class="social" href="//facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="social" href="//linkedin.com/company/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a class="social" href="//twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a class="social" href="//medium.com/@" target="_blank"><i class="fab fa-medium-m"></i></a></li>
            <li><a class="social" href="//pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <div class="header">About Us</div>
        <ul>
          <li><a href="{{route('about')}}">About Tools</a></li>
          <li><a href="#">News</a></li>
          <li><a href="{{route('contact')}}">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <div class="header">Customer Panel</div>
        <ul>
          <li><a href="{{ route('login') }}">My Account</a></li>
          <li><a href="{{route('favoriteProductsView')}}">Favorites</a></li>
          <li><a href="{{route('cartProductsView')}}">Shopping Cart</a></li>
        </ul>
      </div>
    </div>
    <!-- Footer End -->

    <div class="copyright">
      <p class="d-inline-block">&copy; {{date('Y')}} www.tools.com.bd</p>
      <ul class="float-right">
        <li><a href="#">Sitemap</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>

  </div>
  <!-- container area End -->

</footer>
