@extends('layouts.app')

@section('content')
<div class="container mt-5 authPage">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="h2 mb-4">{{ __('Register') }}</div>
            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Please insert your name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="nickname">{{ __('Nickname') }}</label>
                            <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" placeholder="Insert your nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>
                            @error('nickname')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Insert your username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="mobile">{{ __('Mobile') }}</label>
                            <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Insert your mobile number" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                            @error('mobile')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Insert a password" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Insert your email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="dob">{{ __('Birthday') }}</label>
                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nidn">{{ __('NID Number') }}</label>
                            <input id="nidn" type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn" placeholder="Insert your NID number" value="{{ old('nidn') }}" required autocomplete="nidn">
                            @error('nidn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="brn">{{ __('Birthday Certificate No.') }}</label>
                            <input id="brn" type="text" class="form-control @error('brn') is-invalid @enderror" name="brn" placeholder="Insert your Birth Certificate number" value="{{ old('brn') }}" required autocomplete="brn">
                            @error('brn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="gender">{{ __('Gender') }}</label>
                            <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                              <option value="1">Male</option>
                              <option value="2">Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Insert your Birth Certificate number" required autocomplete="address">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <button type="submit" class="btn bg-accent">{{ __('Register') }}</button>
                    </form>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
