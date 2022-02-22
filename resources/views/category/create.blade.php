@extends('dashboard.dashboard_master');
@section('page_title')
Add Category
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Add Category
            </div>
            <div class="card-body">

                <form action=" {{ route('category.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="category_name" class="form-label">Category Name</label>
                      <input type="text"
                        class="@error('category_name') is-invalid @enderror form-control" name="category_name" id="category_name" aria-describedby="helpId" placeholder="">
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_photo" class="form-label">Category Photo</label>
                        <input type="file"
                          class="@error('category_photo') is-invalid @enderror form-control" name="category_photo" id="category_photo" aria-describedby="helpId" placeholder="">
                          @error('category_photo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    <button class="btn btn-info btn-sm" type="submit">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
