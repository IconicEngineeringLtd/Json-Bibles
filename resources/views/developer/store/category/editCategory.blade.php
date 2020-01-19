@extends('developer.store.storeFrame')

@section('storeContents')

  @if (session('status'))
    <div class="alert alert-success" role="alert" id="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="storeAdd stores">
    <h2 class="mb-4">Category Informations</h2>
    <form class="mb-5" action="{{ route('developerCategoryUpdate') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Category Name (Required)</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" onkeyup="url_gen()" value="{{ $category->name . old('name') }}" placeholder="Please insert Category name." required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="url">Category Url (Required)</label>
          <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" onkeyup="slug_gen()" value="{{ $category->url . old('url') }}" placeholder="Will be generated automatically" required autofocus>
          @if ($errors->has('url'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('url') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <!-- Seo -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="">Meta title</label>
          <input class="form-control" type="text" name="meta_title" value="{{ $category->meta_title . old('meta_title') }}" id="meta_title" placeholder="Enter meta title...">
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Slug</label>
          <input class="form-control{{ $errors->has('meta_slug') ? ' is-invalid' : '' }}" type="text" name="meta_slug" value="{{ $category->meta_slug . old('meta_slug') }}" id="meta_slug" placeholder="Enter meta slug...">
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
          <textarea class="form-control" type="text" name="meta_description" placeholder="Enter meta description...">{{ $category->meta_description . old('meta_description') }}</textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Keyword</label>
          <textarea class="form-control" type="text" name="meta_keywords" placeholder="Enter meta keywords...">{{ $category->meta_keywords . old('meta_keywords') }}</textarea>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="banner">Upload Banner</label>
          <input class="form-control-file" type="file" name="banner" value="{{ old('banner') }}" id="banner">
          <small id="banner" class="form-text text-muted">Recommended Size: 1280x112 pixel</small>
          @if ($errors->has('banner'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('banner') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="cover">Upload Cover</label>
          <input class="form-control-file" type="file" name="cover" value="{{ old('cover') }}" id="cover">
          <small id="cover" class="form-text text-muted">Recommended Size: 942x300 pixel</small>
          @if ($errors->has('cover'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('cover') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <button type="submit" class="btn btn-pico-lg" name="category_id" value="{{$category->id}}">Update Now</button>
    </form>
  </div>
@endsection
