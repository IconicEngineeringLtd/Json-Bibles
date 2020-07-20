<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical -->
    <link rel="canonical" href="{{url()->current()}}" />
    <meta name="theme-color" content="#C4161C">
    <!-- Meta Tags -->
    @if(isset($headinfos))
      @foreach($headinfos as $headinfo)
        {!! $headinfo !!}
      @endforeach
      @else
        <title>{{ config('app.name', 'Tools.com.bd') }}</title>
    @endif
    <meta property="og:url" content="{{url()->current()}}">
    @if(isset($metaImage))
      <link rel="icon" href="{{ asset("/storage/$metaImage") }}">
      <meta property="og:image" content="{{ asset("/storage/$metaImage") }}">
      <meta name="twitter:image" content="{{ asset("/storage/$metaImage") }}">
    @else
      <link rel="icon" href="{{ asset('/storage/vendor/logo/favicon.png') }}">
    @endif
    <!-- Static -->
    <meta property="og:site_name" content="Tools.com.bd" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Tools.com.bd">
    <meta property="fb:app_id" content="" />
    <meta name="twitter:site" content="@ToolBangladesh" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@ToolBangladesh" />
    <!-- Static -->
    <!-- Schema Markup Start -->
    @if(isset($schema))
      {!!$schema!!}
    @endif
    <!-- Schema Markup End -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Anton|Exo|Ropa+Sans|Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jams.css') }}" rel="stylesheet">
    @auth
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @endauth
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

    <!-- Google Analytics Start -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121778152-3"></script>
      <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-121778152-3');
      </script>
    <!-- Google Analytics End -->
</head>
<body>
    <div id="app">
        @include('layouts.topbar')
        <!-- Navbar Start -->
          @include('layouts.navbar')
          <!-- Stcicky Navbar -->
            <div id="stickyNavbar">
              @include('layouts.navbar')
            </div>
        <!-- Navbar End -->
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @include('layouts.jsfiles')
    @include('layouts.widgets')
</body>
</html>
