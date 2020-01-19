@extends('common.profile.frame')

@section('profileContent')

@if (session('status'))
  <div class="alert alert-success" role="alert" id="alert">
    {{ session('status') }}
  </div>
@endif
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card">
  <div class="card-header bg-accent text-white">
      Change Password
  </div>
  <div class="card-body">
      <form action="{{route('userSettingsPasswordUpdate', Auth::id())}}" method="post">
        @csrf
          <div class="form-group">
              <label class="text-muted">Current Password</label>
              <input type="password" class="form-control" name="current_password">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="text-muted">New Password</label>
              <input type="password" class="form-control" name="new_password">
            </div>
            <div class="form-group col-md-6">
              <label class="text-muted">Confirm Password</label>
              <input type="password" class="form-control" name="new_password_confirmation">
            </div>
          </div>
          <button type="submit" class="btn bg-accent text-white">Change Now</button>
      </form>
  </div>
</div>

@endsection
