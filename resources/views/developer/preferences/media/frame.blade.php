@extends('layouts.app')

@section('content')
<div class="container admin mt-4">
    <div class="row">
      <div class="col-md-2 mb-1">
        <div class="admin-nav-box">
          <!-- <div class="admin-nav-header">Navigations</div> -->
          <div class="admin-navs">
            <a href="{{ route('dashboard') }}" class="admin-nav-link"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
            <a href="{{ route('developerPreferences') }}" class="admin-nav-link"><i class="fas fa-images"></i>&nbsp;&nbsp;Slider</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Profile</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-chart-line"></i>&nbsp;&nbsp;Analytics</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-wallet"></i>&nbsp;&nbsp;My Walllet</a>
          </div>
        </div>
      </div>
      <div class="col-md-10 mb-1">
          @yield('preferencesContents')
      </div>
    </div>
</div>
@endsection
