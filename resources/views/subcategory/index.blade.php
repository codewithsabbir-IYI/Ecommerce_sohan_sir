@extends('dashboard.dashboard_master');
@section('page_title')
All Sub Category
@endsection
@section('dashboard_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                All Sub Category
            </div>
            <div class="card-body">
                @if (session('subcategory_added'))
                    <div class="alert alert-success">
                        {{ session('subcategory_added') }}
                    </div>
                @endif
                @if (session('subcategory_updated'))
                    <div class="alert alert-success">
                        {{ session('subcategory_updated') }}
                    </div>
                @endif
                @if (session('harddelete'))
                    <div class="alert alert-success">
                        {{ session('harddelete') }}
                    </div>
                @endif
                <table class="table table-striped table-inverse ">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>ID</th>
                            <th>Sub Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories_group as $category)

                                <tr class="text-center">
                                    <td scope="row" colspan="5">{{App\Models\Category::find($category->category_id)->category_name}} </td>
                                </tr>
                                @forelse (App\Models\Subcategory::where('category_id',$category->category_id)->get() as $subcategory)
                                <tr>
                                    <td scope="row">{{$subcategory->id}} </td>

                                    <td scope="row">{{$subcategory->subcategory_name}} </td>
                                    <td>
                                        <a href="{{route('subcategory.show',$subcategory->id)}} " class="btn btn-info btn-sm">See Details</a>
                                        <a href="{{route('subcategory.edit',$subcategory->id)}} " class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('subcategory.destroy',$subcategory->id) }} " method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm delete_button_form">Soft Delete</button>
                                        </form>
                                        <form action="{{ route('subcategory.harddelete',$subcategory->id) }} " method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete_button_form">Permamently Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @empty

                                @endforelse

                            @empty
                            <td>No Category to show</td>
                            @endforelse


                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


@endsection
