@extends('developer.store.storeFrame')

@section('storeContents')

<div class="storeAdd">
  @if (session('status'))
    <div class="alert alert-success" role="alert" id="alert">
      {{ session('status') }}
    </div>
  @endif
  <h2 class="mb-4">Assign Sub Category</h2>
  <form action="{{ route('developerAssignSubCatDone') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- First Row -->
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="category_id">Category Name (Required)</label>
        <select id="category_id" name="category_id" class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
          <option value="">--Select One--</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" <?php echo($category->id == $currentCat->id)?"selected":"";?>>{{ $category->name }}</option>
          @endforeach
        </select>
        @if ($errors->has('category_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-pico-lg">Assign Now</button>
    <hr>
    @foreach($sub_categories as $sub_category)
      <div class="form-check float-left mr-3 mb-2 btn btn-outline-dark">
        <input type="checkbox" name="sub_categories[]" id="sub_category/{{$sub_category->id}}" value="{{$sub_category->id}}" class="form-check-input" <?php foreach ($currentCat->subCategories as $subCat){echo ($subCat->id == $sub_category->id)?'checked':'';}?>>
        <label for="sub_category/{{$sub_category->id}}" class="form-check-label">{{$sub_category->name}}</label>
      </div>
    @endforeach
  </form>
</div>
@endsection
