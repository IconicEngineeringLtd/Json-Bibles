@extends('developer.preferences.media.frame')

@section('preferencesContents')
  @if (session('status'))
    <div class="alert alert-success" role="alert" id="alert">
      {{ session('status') }}
    </div>
  @endif
  <div class="row mx-0 mb-5">
    <div class="col-md-12 px-0">
      <h2 class="mb-4">Slider Informations</h2>
      <form action="{{ route('developerSliderSubmit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="image">Upload Image</label>
          <input class="form-control-file" type="file" name="image" value="{{ old('image') }}" id="image">
          <small id="image" class="form-text text-muted">Recommended Size: 960x354 pixel</small>
          @if ($errors->has('image'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="header">Slider Header (Optional)</label>
            <input class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" type="text" name="header" value="{{ old('header') }}" id="header" placeholder="Enter slider header">
            @if ($errors->has('header'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('header') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group col-md-6">
            <label for="content">Slider Content (Optional)</label>
            <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" type="text" name="content" value="{{ old('content') }}" id="content" placeholder="Enter slider content">
            @if ($errors->has('content'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('content') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="position">Slider Position (Optional)</label>
            <input class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" type="text" name="position" value="{{ old('position') }}" id="position" placeholder="Enter slider position">
            @if ($errors->has('position'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('position') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group col-md-6">
            <label for="privacy">Slider Privacy (Optional)</label>
            <select class="form-control{{ $errors->has('privacy') ? ' is-invalid' : '' }}" name="privacy" id="privacy">
              <option value="1">Shown</option>
              <option value="0">Hidden</option>
            </select>
            @if ($errors->has('privacy'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('privacy') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <button type="submit" class="btn btn-pico-lg">Submit Now</button>
      </form>
    </div>
  </div>

  <h2 class="mb-4 d-block">Sliders</h2>
  <div class="row mx-0 devSliders">
    @foreach($sliders as $slider)
      <div class="slider col-md-3 px-1">
        <div class="card">
          <img src='{{asset("/storage/$slider->thumbnail_small")}}' class="card-image-top" height="100" width="auto">
        </div>
        <div class="overlay">
          <div class="components">
            <button class="btn btn-success" data-toggle="modal" data-target="#sliderEdit{{$slider->id}}"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#sliderDelete{{$slider->id}}"><i class="fas fa-trash"></i></button>
          </div>
        </div>
      </div>
      <!-- Modal for Edit -->
      <div class="modal fade" id="sliderEdit{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="sliderEditTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="form" action="{{route('developerSliderUpdate')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="sliderEditLongTitle">Edit Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <img src='{{asset("/storage/$slider->image")}}' class="card-image-top" height="83" width="auto">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="image">Upload Image</label>
                    <input class="form-control-file" type="file" name="image" value="{{ old('image') }}" id="image">
                    <small id="image" class="form-text text-muted">Recommended Size: 960x354 pixel</small>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="header">Slider Header (Optional)</label>
                    <input class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" type="text" name="header" value="{{ $slider->header }}" id="header" placeholder="Header">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="content">Slider Content (Optional)</label>
                    <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" type="text" name="content" value="{{ $slider->content }}" id="content" placeholder="Content">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="position">Slider Position (Optional)</label>
                    <input class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" type="text" name="position" value="{{ $slider->position }}" id="position" placeholder="Position">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="privacy">Slider Privacy (Optional)</label>
                    <select class="form-control{{ $errors->has('privacy') ? ' is-invalid' : '' }}" name="privacy" id="privacy">
                      <option value="1" <?php echo($slider->privacy == 1)?"selected":"";?>>Shown</option>
                      <option value="0" <?php echo($slider->privacy == 0)?"selected":"";?>>Hidden</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="sliderId" value="{{$slider->id}}">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal for Delete -->
      <div class="modal fade" id="sliderDelete{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="sliderDeleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="form" action="{{route('developerSliderDelete')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="sliderDeleteLongTitle"><i class="fas fa-exclamation-triangle text-danger" style="font-size:25px;"></i>&nbsp;&nbsp;Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to delete this slider image?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger" name="sliderId" value="{{$slider->id}}">Yes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
