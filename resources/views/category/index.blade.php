@extends('layouts.app');
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    All Category
                </div>
                <div class="card-body">
                    @if (session('category_added'))
                        <div class="alert alert-success">
                            {{ session('category_added') }}
                        </div>
                    @endif
                    @if (session('category_updated'))
                        <div class="alert alert-success">
                            {{ session('category_updated') }}
                        </div>
                    @endif
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse|thead-default">
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td scope="row">{{$category->id}} </td>
                                    <td scope="row">{{$category->category_name}} </td>
                                    <td>
                                        <a href="{{route('category.show',$category->id)}} " class="btn btn-info btn-sm">See Details</a>
                                        <a href="{{route('category.edit',$category->id)}} " class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('category.destroy',$category->id) }} " method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mt-2"     >delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <td>No Category to show</td>
                                @endforelse


                            </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
