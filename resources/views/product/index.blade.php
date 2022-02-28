@extends('dashboard.dashboard_master');
@section('page_title')
All Products
@endsection
@section('dashboard_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                All Products
            </div>
            <div class="card-body">
                {{-- @if (session('category_added'))
                    <div class="alert alert-success">
                        {{ session('category_added') }}
                    </div>
                @endif
                @if (session('category_updated'))
                    <div class="alert alert-success">
                        {{ session('category_updated') }}
                    </div>
                @endif
                @if (session('harddelete'))
                    <div class="alert alert-success">
                        {{ session('harddelete') }}
                    </div>
                @endif --}}
                <table class="table table-striped table-inverse">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>Product Name</th>
                            {{-- <th>Slug</th> --}}
                            <th>Product Regular Price</th>
                            {{-- <th>Product Discounted Price</th>
                            <th>Product Short Description</th>
                            <th>Product Sku</th>
                            <th>Category Id</th>
                            <th>Subcategory Id</th>
                            <th>Product Weight</th>
                            <th>Product Dimensions</th>
                            <th>Product Materials</th>
                            <th>Product Other Info</th>
                            <th>Product Long Description</th> --}}
                            <th>Product Thumbnail Photo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)

                            <tr>
                                <td scope="row">{{$product->product_name}} </td>
                                {{-- <td scope="row">{{$product->slug}} </td> --}}
                                <td scope="row">{{$product->product_regular_price}} </td>
                                {{-- <td scope="row">{{$product->product_discounted_price}} </td>
                                <td scope="row">{{$product->product_short_description}} </td>
                                <td scope="row">{{$product->product_sku}} </td>
                                <td scope="row">{{$product->category_id}} </td>
                                <td scope="row">{{$product->subcategory_id}} </td>
                                <td scope="row">{{$product->product_weight}} </td>
                                <td scope="row">{{$product->product_dimensions}} </td>
                                <td scope="row">{{$product->product_materials}} </td>
                                <td scope="row">{{$product->product_other_info}} </td>
                                <td scope="row">{{$product->product_long_description}} </td> --}}
                                <td scope="row">

                                    <img src=" {{ asset('frontend/uploads/product_thumbnail_photo') }}/{{$product->product_thumbnail_photo}} " alt="not found" >
                                </td>
                                <td>
                                    <a href="{{route('product.show',$product->id)}} " class="btn btn-info btn-sm">See Details</a>
                                    <a href="{{route('product.edit',$product->id)}} " class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('product.destroy',$product->id) }} " method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary btn-sm mt-2">Soft Delete</button>
                                    </form>
                                    <form action="{{ route('product.harddelete',$product->id) }} " method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Permamently Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">No Data To Show</td>
                            </tr>
                            @endforelse


                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


@endsection
