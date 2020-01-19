@extends('developer.store.storeFrame')

@section('storeContents')

  @if (session('status'))
  <div class="alert alert-success" role="alert" id="alert">
    {{ session('status') }}
  </div>
  @endif

  <div class="storeAdd stores">
    <h2 class="mb-4">Category Informations</h2>
    <form class="mb-5" action="{{ route('developerCategorySubmit') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Category Name (Required)</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" onkeyup="url_gen()" value="{{ old('name') }}" placeholder="Please insert Category name." required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="url">Category Url (Required)</label>
          <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" onkeyup="slug_gen()" value="{{ old('url') }}" placeholder="Will be generated automatically" required autofocus>
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
      <button type="submit" class="btn btn-pico-lg">Add Now</button>
    </form>

    <h2 class="mb-4">Assign Sub Categories</h2>
    <!-- Show Available Brands -->
    <div class="row">
      @if(count($categories) != 0)
        @foreach($categories as $category)
          <div class="col-md-4 p-0 px-1 mb-2 devSubCats">
            <a href="{{ route('developerAssignSubCat', $category->id) }}" class="store">
              <i class="fas fa-store"></i>
              <p>{{ $category->name }}</p>
              <p>{{ count($category->subCategories) }}</p>
            </a>
            <!-- Buttons for Action -->
            <div class="actionBtn">
              <a href="{{ route('developerCategoryEdit', $category->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
              <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#categoryDelete{{$category->id}}"><i class="fas fa-trash"></i></button> -->
            </div>
            <!-- Modal for Delete -->
            <!-- <div class="modal fade" id="categoryDelete{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="categoryDeleteTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <form class="form" action="{{route('developerSubCategoryDelete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                      <h5 class="modal-title" id="categoryDeleteLongTitle"><i class="fas fa-exclamation-triangle text-danger" style="font-size:25px;"></i>&nbsp;&nbsp;Warning!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure to delete this sub category?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger" name="sub_category_id" value="{{$category->id}}">Yes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div> -->
          </div>
        @endforeach
        @else
        <div class="col-md-4 p-0 px-1 mb-1">
          <div class="store">
            <i class="fas fa-plus-circle"></i>
            <p>No Categories Available!</p>
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection
