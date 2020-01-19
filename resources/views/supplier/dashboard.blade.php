@extends('layouts.app')

@section('content')
<div class="container admin mt-4">
    <div class="row">
      <div class="col-md-2 mb-1">
        <div class="admin-nav-box">
          <!-- <div class="admin-nav-header">Navigations</div> -->
          <div class="admin-navs">
            @php
              if(Auth::user()->username != NULL){
                $userIdentifier = Auth::user()->username;
              }else{$userIdentifier = Auth::id();}
            @endphp
            <a href="{{ route('stores') }}" class="admin-nav-link"><i class="fas fa-store"></i>&nbsp;&nbsp;My Store</a>
            <a href="{{ route('userProfile', $userIdentifier) }}" class="admin-nav-link"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Profile</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-chart-line"></i>&nbsp;&nbsp;Analytics</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-wallet"></i>&nbsp;&nbsp;My Walllet</a>
          </div>
        </div>
      </div>
      <div class="col-md-10 mb-1">
          <div class="card">
              <div class="card-header">Dashboard</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  You are logged in!
              </div>
          </div>
      </div>
    </div>
</div>
@endsection
