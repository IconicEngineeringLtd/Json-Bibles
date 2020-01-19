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
            <a href="{{ route('userProfile', $userIdentifier) }}" class="admin-nav-link"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Profile</a>
            <a href="{{ route('userSettings', $userIdentifier) }}" class="admin-nav-link"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Settings</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
            <a href="#" class="admin-nav-link"><i class="fas fa-wallet"></i>&nbsp;&nbsp;My Walllet</a>
          </div>
        </div>
      </div>
      <div class="col-md-10 mb-1">
          @yield('profileContent')
      </div>
    </div>
</div>
@endsection
