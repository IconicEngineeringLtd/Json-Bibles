@extends('common.profile.frame')

@section('profileContent')
@if (session('status'))
    <div id="alert" class="alert alert-success" role="alert">
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
      General Informations
  </div>
  <div class="card-body">
      <form action="{{route('userSettingsInfoUpdate', Auth::id())}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $userInfo->name }}" required>
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Nickname</label>
            <input type="text" class="form-control" name="nickname" value="{{ $userInfo->nickname }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">Username</label>
            <input type="text" class="form-control" name="username" value="{{ $userInfo->username }}" readonly>
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $userInfo->email }}" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">NID No.</label>
            <input type="text" class="form-control" name="nidn" value="{{ $userInfo->nidn }}"readonly>
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Birth Registration No.</label>
            <input type="text" class="form-control" name="brn" value="{{ $userInfo->brn }}" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">Mobile</label>
            <input type="text" class="form-control" name="mobile" value="{{ $userInfo->mobile }}">
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Reg. IP</label>
            <input type="text" class="form-control" name="ipAddress" value="{{ $userInfo->ipAddress }}"readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">Gender</label>
            <select class="form-control" name="gender">
              <option value="1" <?php echo($userInfo->gender == '1')?"selected":"";?>>Male</option>
              <option value="0" <?php echo($userInfo->gender == '0')?"selected":"";?>>Female</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Birthday</label>
            <input type="date" class="form-control" name="dob" value="{{ $userInfo->dob }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="text-muted">Address</label>
            <textarea class="form-control" name="address">{{ $userInfo->address }}</textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="text-muted">Registered at:</label>
            <input type="text" class="form-control" name="created_at" value="{{$userInfo->created_at->diffForhumans()}}"readonly>
          </div>
          <div class="form-group col-md-6">
            <label class="text-muted">Updated at: Photo</label>
            <input type="text" class="form-control" name="updated_at" value="{{$userInfo->updated_at->diffForhumans()}}"readonly>
          </div>
        </div>
          <button type="submit" class="btn bg-accent text-white">Update</button>
      </form>
  </div>
</div>

@endsection
