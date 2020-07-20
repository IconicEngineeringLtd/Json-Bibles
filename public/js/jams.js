$(document).ready(function(){

  // Slick Carousel
    $('.mainSlider').slick({
      dots: false,
      // arrows: false,
      prevArrow:"<button type='button' class='btnLeft'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:"<button type='button' class='btnRight'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      infinite: true,
      speed: 500,
      autoplay: true,
      autoplaySpeed: 2000,
      fade: true,
      cssEase: 'linear',
    });
    // Manual Slider
    $('.productSliderManual').slick({
      dots: false,
      // arrows: false,
      prevArrow:"<button type='button' class='btnLeft'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:"<button type='button' class='btnRight'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      infinite: true,
      slidesToShow: 5,
      slidesPerRow: 5,
      speed: 250,
      autoplay: false,
      autoplaySpeed: 1500,
      fade: false,
      cssEase: 'linear',
      responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      }],
    });
    $('.relatedProductsManual').slick({
      dots: false,
      // arrows: false,
      prevArrow:"<button type='button' class='btnLeft'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:"<button type='button' class='btnRight'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      infinite: true,
      slidesToShow: 4,
      slidesPerRow: 4,
      speed: 250,
      autoplay: false,
      autoplaySpeed: 1500,
      fade: false,
      cssEase: 'linear',
      responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      }],
    });
    // Auto Slider
    $('.productSlider').slick({
      dots: false,
      // arrows: false,
      prevArrow:"<button type='button' class='btnLeft'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:"<button type='button' class='btnRight'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      infinite: true,
      slidesToShow: 4,
      slidesPerRow: 4,
      speed: 250,
      autoplay: true,
      autoplaySpeed: 1500,
      fade: false,
      cssEase: 'linear',
      responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      }],
    });

  // Sticky Navbar Start
  $(window).trigger('scroll');
  $(window).bind('scroll', function () {
    var pixels = 35; //number of pixels before modifying styles
    if ($(window).scrollTop() > pixels) {
      $('#stickyNavbar').fadeIn(0);
    } else {
      $('#stickyNavbar').fadeOut(0);
    }
  });
  // Sticky Navbar End

  // Scroll to top start
  $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
          $('#scrolltop').fadeIn();
      } else {
          $('#scrolltop').fadeOut();
      }
  });
  $('#scrolltop').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
  });
  // Scroll to top end

});

// URL Generator
function url_gen() {
var str = document.getElementById("title").value;
var trims = str.trim();
var url = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
document.getElementById("url").value = url.toLowerCase();

document.getElementById("meta_title").value = str;

document.getElementById("meta_slug").value = url.toLowerCase();
}
// Meta Slug Generator
function slug_gen() {
var str = document.getElementById("url").value;
var trims = str.trim();
var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
document.getElementById("meta_slug").value = slug.toLowerCase();
}
