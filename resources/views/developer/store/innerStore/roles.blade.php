@extends('admin.store.innerStore.frame')

@section('storeContents')

  <div class="storeAdd stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">Assign role</h2>
    <form action="{{ route('adminRoleAssigned') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="store_id">Store Name (Required)</label>
          <select id="store_id" name="store_id" class="form-control {{ $errors->has('store_id') ? ' is-invalid' : '' }}" required>
            <option value="{{ $store->id }}">{{ $store->name }}</option>
          </select>
          @if ($errors->has('store_id'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('store_id') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="role_id">Role Name (Required)</label>
          <select id="role_id" name="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" required>
            @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
          @if ($errors->has('role_id'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('role_id') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="user_id">User Name (Required)</label>
          <select id="user_id" name="user_id" class="form-control {{ $errors->has('user_id') ? ' is-invalid' : '' }}" required>
            @foreach($users as $user)
              @if($user->id != Auth::id())
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endif
            @endforeach
          </select>
          @if ($errors->has('user_id'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('user_id') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <button type="submit" class="btn btn-pico-lg">Submit Now</button>
    </form>
    <hr>
    <!-- Show Available Brands -->
    <div class="row">
      @if(count($store->admins) != 0)
        @foreach($store->admins as $admin)
          <div class="col-md-4 p-0 px-1 mb-2">
            <a href="#" class="store">
              <i class="fas fa-tag"></i>
              <p>{{ $admin->name }}</p>
            </a>
          </div>
        @endforeach
        @else
        <div class="col-md-4 p-0 px-1 mb-1">
          <div class="store">
            <i class="fas fa-tag"></i>
            <p>No Admin Available!</p>
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection
