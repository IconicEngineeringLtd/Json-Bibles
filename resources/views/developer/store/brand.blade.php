@extends('developer.store.storeFrame')

@section('storeContents')

  <div class="storeAdd stores">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">Brand Informations</h2>
    <form action="{{ route('developerBrandSubmit') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Brand Name (Required)</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" onkeyup="url_gen()" value="{{ old('name') }}" placeholder="Please insert Brand name." required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="country">Brand Country (Optional)</label>
          <input type="text" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" name="country" value="{{ old('country') }}" placeholder="Please insert Brand country.">
          @if ($errors->has('country'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('country') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label for="url">Brand Url (Required)</label>
        <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" onkeyup="slug_gen()" value="{{ old('url') }}" placeholder="Will be generated automatically" required>
        @if ($errors->has('url'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
        @endif
      </div>
      <!-- Seo -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="">Meta title</label>
          <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title') }}" id="meta_title" placeholder="Enter meta title...">
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Slug</label>
          <input class="form-control{{ $errors->has('meta_slug') ? ' is-invalid' : '' }}" type="text" name="meta_slug" value="{{ old('meta_slug') }}" id="meta_slug" placeholder="Enter meta slug...">
          @if ($errors->has('meta_slug'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('meta_slug') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="">Meta description</label>
          <textarea class="form-control" type="text" name="meta_description" placeholder="Enter meta description...">{{ old('meta_description') }}</textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Keyword</label>
          <textarea class="form-control" type="text" name="meta_keywords" placeholder="Enter meta keywords...">{{ old('meta_keywords') }}</textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-pico-lg">Submit Now</button>
    </form>
    <hr>
    <!-- Show Available Brands -->
    <div class="row">
      @if(count(App\Brands::all()) != 0)
        @foreach(App\Brands::all() as $brand)
          <div class="col-md-4 p-0 px-1 mb-2">
            <a href="#" class="store">
              <i class="fas fa-store"></i>
              <p>{{ $brand->name }}</p>
            </a>
          </div>
        @endforeach
        @else
        <div class="col-md-4 p-0 px-1 mb-1">
          <div class="store">
            <i class="fas fa-info-circle"></i>
            <p>No Brands Available!</p>
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection
