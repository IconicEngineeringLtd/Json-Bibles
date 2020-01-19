@extends('supplier.store.innerStore.frame')

@section('storeContents')

  <div class="storeAdd">
    @if (session('status'))
      <div class="alert alert-success" role="alert" id="alert">
        {!! session('status') !!}
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
    <h2 class="mb-4">Product Informations</h2>
    <form action="{{ route('supplierProductSubmit') }}" enctype="multipart/form-data" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-9">
          <!-- First Row -->
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
              <label for="category_id">Category Name (Required)</label>
              <select id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
                <option value="">--Select One--</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('category_id'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('category_id') }}</strong>
                  </span>
              @endif
              <script type="text/javascript">
                $(document).ready(function(){
                	$('#category_id').change(function() {
                		var category_id = $(this).val();
                    var query_for = "sub_category_productAdd";
                		$.ajaxSetup({
                			headers: {
                				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                			}
                		});
                		$.ajax({
                			type:'POST',
                			url:'/AjaxRequest',
                			data: {query_for: query_for, category_id: category_id},
                			success: function (data) {
                				$( "#sub_category_id" ).html(data);
                			}
                		});
                	});
                });
                </script>
            </div>
          </div>
          <!-- Second Row -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="sub_category_id">Sub Category Name (Required)</label>
              <select id="sub_category_id" name="sub_category_id" class="form-control {{ $errors->has('sub_category_id') ? ' is-invalid' : '' }}" required>

              </select>
              @if ($errors->has('sub_category_id'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('sub_category_id') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="brand_id">Brand Name (Required)</label>
              <select id="brand_id" name="brand_id" class="form-control {{ $errors->has('brand_id') ? ' is-invalid' : '' }}" required>
                <option value="">--Select One--</option>
                @foreach($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('brand_id'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('brand_id') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <!-- Third Row -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="model">Model (Required)</label>
              <input type="text" id="model" name="model" class="form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" value="{{ old('model') }}" placeholder="Ex: Fluke Ti401 PRO" required>
              @if ($errors->has('model'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('model') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="title">Title (Required)</label>
              <input type="text" id="title" name="title"  onkeyup="url_gen()" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" placeholder="Ex: Fluke Ti401 PRO - Thermal Imaging Camera" required>
              @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <!-- Fourth Row -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="url">Url (Required)</label>
              <input type="text" id="url" name="url" onkeyup="slug_gen()" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}"  value="{{ old('url') }}" placeholder="Will be generated automatically" required>
              @if ($errors->has('url'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('url') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="price">Price (Required)</label>
              <input type="text" id="price" name="price" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" placeholder="Ex:  Thermal Imaging Camera" required>
              @if ($errors->has('price'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('price') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="product_image">Product Image (Required)</label>
            <input type="file" id="product_image" name="product_image" class="form-control-file {{ $errors->has('product_image') ? ' is-invalid' : '' }}" required>
            @if ($errors->has('product_image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('product_image') }}</strong>
                </span>
            @endif
          </div>
          <!-- Tabs -->
          <div class="mb-2">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
                <a class="nav-item nav-link" id="nav-features-tab" data-toggle="tab" href="#nav-features" role="tab" aria-controls="nav-features" aria-selected="false">Features</a>
                <a class="nav-item nav-link" id="nav-spec-tab" data-toggle="tab" href="#nav-spec" role="tab" aria-controls="nav-spec" aria-selected="false">Specifications</a>
                <a class="nav-item nav-link" id="nav-includes-tab" data-toggle="tab" href="#nav-includes" role="tab" aria-controls="nav-includes" aria-selected="false">Includes</a>
                <a class="nav-item nav-link" id="nav-accessories-tab" data-toggle="tab" href="#nav-accessories" role="tab" aria-controls="nav-accessories" aria-selected="false">Accessories</a>
              </div>
            </nav>
            <div class="tab-content pt-1" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                <textarea class="form-control tinymce" name="overview" placeholder="Insert overview">{{ old('overview') }}</textarea>
              </div>
              <div class="tab-pane fade" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab">
                <textarea class="form-control tinymce" name="features" placeholder="Insert features">{{ old('features') }}</textarea>
              </div>
              <div class="tab-pane fade" id="nav-spec" role="tabpanel" aria-labelledby="nav-spec-tab">
                <textarea class="form-control tinymce" name="specifications" placeholder="Insert specifications">{{ old('specifications') }}</textarea>
              </div>
              <div class="tab-pane fade" id="nav-includes" role="tabpanel" aria-labelledby="nav-includes-tab">
                <textarea class="form-control tinymce" name="includes" placeholder="Insert includes">{{ old('includes') }}</textarea>
              </div>
              <div class="tab-pane fade" id="nav-accessories" role="tabpanel" aria-labelledby="nav-accessories-tab">
                <textarea class="form-control tinymce" name="accessories" placeholder="Insert accessories">{{ old('accessories') }}</textarea>
              </div>
            </div>
          </div>
          <!-- Seo -->
          <div class="form-group">
            <label for="">Meta title</label>
            <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title') }}" id="meta_title" placeholder="Enter meta title...">
          </div>
          <div class="form-group">
            <label for="">Meta Slug</label>
            <input class="form-control{{ $errors->has('meta_slug') ? ' is-invalid' : '' }}" type="text" name="meta_slug" value="{{ old('meta_slug') }}" id="meta_slug" placeholder="Enter meta slug...">
            @if ($errors->has('meta_slug'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('meta_slug') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Meta description</label>
            <textarea class="form-control" type="text" name="meta_description" placeholder="Enter meta description...">{{ old('meta_description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="">Meta Keyword</label>
            <textarea class="form-control" type="text" name="meta_keywords" placeholder="Enter meta keywords...">{{ old('meta_keywords') }}</textarea>
          </div>

          <button type="submit" class="btn btn-pico-lg">Submit Now</button>
        </div>
        <div class="col-md-3">
          <label>Assign Tags (Optional)</label>
          @foreach($store->tags as $tag)
            <div class="form-check float-left mr-3 mb-2 btn btn-outline-dark">
              <input type="checkbox" name="tags[]" id="tag/{{$tag->id}}" value="{{$tag->id}}" class="form-check-input">
              <label for="tag/{{$tag->id}}" class="form-check-label">{{$tag->name}}</label>
            </div>
          @endforeach
        </div>
      </div>
    </form>
  </div>

@endsection
