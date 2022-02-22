@extends('dashboard.dashboard_master');
@section('page_title')
Add Sub Category
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Add Sub Category
            </div>
            <div class="card-body">

                <form action=" {{ route('subcategory.store')}} " method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="category_name" class="form-label">Category Name</label>
                        <div class="mb-3">
                          <select class="form-control" name="category_id">
                            <option>-Select Your Category-</option>
                            @forelse ($categories as $category)
                            <option value=" {{$category->id}} ">{{$category->category_name}}</option>
                            @empty
                            <option>No Data To Show</option>
                            @endforelse
                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror


                          </select>
                        </div>
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subcategory_name" class="form-label">Sub Category Name</label>
                        <input type="text"
                          class="@error('subcategory_name') is-invalid @enderror form-control" name="subcategory_name" id="subcategory_name" aria-describedby="helpId" placeholder="">
                          @error('subcategory_name')
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

