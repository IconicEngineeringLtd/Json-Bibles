@extends('supplier.store.storeFrame')

@section('storeContents')

  <div class="storeAdd">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {{ session('status') }}
      </div>
    @endif
    <h2 class="mb-4">Store Informations</h2>
    <form action="{{ route('supplierStoreSubmit') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Store Name (Required)</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" onkeyup="url_gen()" value="{{ old('name') }}" placeholder="Please insert your name." required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="type">Store Type (Optional)</label>
          <input type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" value="{{ old('type') }}" placeholder="Please insert your name.">
          @if ($errors->has('type'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('type') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
          <label for="url">Store Url (Required)</label>
          <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" onkeyup="slug_gen()" value="{{ old('url') }}" placeholder="Will be generated automatically" required>
          @if ($errors->has('url'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('url') }}</strong>
              </span>
          @endif
        </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="slogan">Slogan (Optional)</label>
          <input type="text" class="form-control {{ $errors->has('slogan') ? ' is-invalid' : '' }}" id="slogan" name="slogan" value="{{ old('slogan') }}" placeholder="Insert your slogan.">
          @if ($errors->has('slogan'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('slogan') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="trade_license">Trade License</label>
          <input type="text" class="form-control {{ $errors->has('trade_license') ? ' is-invalid' : '' }}" id="trade_license" name="trade_license" value="{{ old('trade_license') }}" placeholder="Insert your Trade License.">
          @if ($errors->has('trade_license'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('trade_license') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="established_at">Established At (Required)</label>
          <input type="date" class="form-control {{ $errors->has('established_at') ? ' is-invalid' : '' }}" id="established_at" name="established_at" value="{{ old('established_at') }}" placeholder="Insert your Starting Date." required>
          @if ($errors->has('established_at'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('established_at') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="logo">Logo (Required)</label>
          <input type="file" class="form-control-file {{ $errors->has('logo') ? ' is-invalid' : '' }}" id="logo" name="logo" value="{{ old('logo') }}">
          @if ($errors->has('logo'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('logo') }}</strong>
              </span>
          @endif
        </div>
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
  </div>

@endsection
