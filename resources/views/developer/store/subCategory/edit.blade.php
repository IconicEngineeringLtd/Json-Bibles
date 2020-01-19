@extends('developer.store.storeFrame')

@section('storeContents')

  @if (session('status'))
    <div class="alert alert-success" role="alert" id="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="storeAdd stores">
    <h2 class="mb-4">Sub Sub Category Informations</h2>
    <form class="mb-5" action="{{ route('developerSubCategoryUpdate') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Sub Category Name (Required)</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" onkeyup="url_gen()" value="{{ $subCategory->name }}" placeholder="Please insert Sub Category name." required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="url">Sub Category Url (Required)</label>
          <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" onkeyup="slug_gen()" value="{{ $subCategory->url }}" placeholder="Will be generated automatically" required autofocus>
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
          <input class="form-control" type="text" name="meta_title" value="{{ $subCategory->meta_title }}" id="meta_title" placeholder="Enter meta title...">
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Slug</label>
          <input class="form-control{{ $errors->has('meta_slug') ? ' is-invalid' : '' }}" type="text" name="meta_slug" value="{{ $subCategory->meta_slug }}" id="meta_slug" placeholder="Enter meta slug...">
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
          <textarea class="form-control" type="text" name="meta_description" placeholder="Enter meta description...">{{ $subCategory->meta_description }}</textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="">Meta Keyword</label>
          <textarea class="form-control" type="text" name="meta_keywords" placeholder="Enter meta keywords...">{{ $subCategory->meta_keywords }}</textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-pico-lg" name="sub_category_id" value="{{$subCategory->id}}">Update Now</button>
    </form>
  </div>
@endsection
