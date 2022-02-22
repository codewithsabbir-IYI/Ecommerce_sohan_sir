@extends('dashboard.dashboard_master');
@section('page_title')
Add Category
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Edit Category
            </div>
            <div class="card-body">
                @if (session('category_updated'))
                    <div class="alert alert-success">
                        {{ session('category_updated') }}
                    </div>
                @endif
                <form action=" {{ route('category.update',$category->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                      <label for="category_name" class="form-label">Category Name</label>
                      <input type="text"
                        class="form-control" name="category_name" id="category_name" aria-describedby="helpId" value="{{$category->category_name}} ">
                    </div>
                    <div class="mb-3">
                        <label for="category_photo" class="form-label">Category Photo: </label>
                        <img src="{{asset('dashboard/uploads/category_photos')}}/{{$category->category_photo}} " alt="Not Found">
                      </div>
                      <div class="mb-3">
                        <label for="category_photo" class="form-label">Add New Photo</label>
                        <input type="file"
                          class="@error('category_photo') is-invalid @enderror form-control" name="category_photo" id="category_photo" aria-describedby="helpId" placeholder="">
                      </div>
                    <button class="btn btn-info btn-sm" type="submit">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
