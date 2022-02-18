@extends('layouts.app');

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Add Category
                    </div>
                    <div class="card-body">
                        @if (session('category_added'))
                            <div class="alert alert-success">
                                {{ session('category_added') }}
                            </div>
                        @endif
                        <form action=" {{ route('category.store')}} " method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="category_name" class="form-label">Category Name</label>
                              <input type="text"
                                class="form-control" name="category_name" id="category_name" aria-describedby="helpId" placeholder="">
                            </div>
                            <button class="btn btn-info btn-sm" type="submit">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
