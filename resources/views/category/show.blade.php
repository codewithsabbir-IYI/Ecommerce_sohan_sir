@extends('dashboard.dashboard_master');
@section('dashboard_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Category Details
            </div>
            <div class="card-body">
                @if (session('category_added'))
                    <div class="alert alert-success">
                        {{ session('category_added') }}
                    </div>
                @endif
                <table class="table table-striped table-inverse ">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td scope="row">{{$category->id}} </td>
                                <td scope="row">{{$category->category_name}} </td>
                                <td scope="row">{{$category->created_at->diffForHumans()}} </td>
                                <td scope="row">{{$category->updated_at}} </td>


                            </tr>

                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
