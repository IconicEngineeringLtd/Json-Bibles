@extends('layouts.app')

@section('content')
<div class="container admin mt-4">
    <div class="row">
      <div class="col-md-2 mb-1 p-0 px-1">
        <div class="admin-nav-box">
          <!-- <div class="admin-nav-header">Navigations</div> -->
          <div class="admin-navs">
            <a href="{{ route('dashboard') }}" class="admin-nav-link"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
            <a href="{{ route('stores') }}" class="admin-nav-link"><i class="fas fa-store"></i>&nbsp;&nbsp;My Store</a>
            <a href="{{ route('supplierStoreAdd') }}" class="admin-nav-link"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Store</a>
          </div>
        </div>
      </div>
        <div class="col-md-10 mb-1">
            @yield('storeContents')
        </div>
    </div>
</div>
@endsection
