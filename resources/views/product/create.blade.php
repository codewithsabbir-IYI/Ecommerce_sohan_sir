@extends('dashboard.dashboard_master');
@section('page_title')
Add Product
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Add Product
            </div>
            <div class="card-body">

                <form action=" {{ route('product.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_name" class="form-label">Product Name: </label>
                                <input type="text" class="form-control" name="product_name" id="product_name" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="product_regular_price" class="form-label">Product Regular Price: </label>
                                <input type="text" class="form-control" name="product_regular_price" id="product_regular_price" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="product_discounted_price" class="form-label">Product Discounted Price: </label>
                                <input type="text" class="form-control" name="product_discounted_price" id="product_discounted_price" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="product_short_description" class="form-label">Product Short Description: </label>
                        <textarea class="form-control" name="product_short_description" id="product_short_description" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category_dropdown" class="form-label">Category Id: </label>
                                  <select class="form-control" name="category_id" id="category_dropdown" >
                                    <option value=" ">Select One Category</option>
                                      @forelse ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                      @empty
                                        <option value=" ">No Category Here</option>
                                      @endforelse
                                  </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="subcategory_dropdown" class="form-label">Subcategory Id: </label>
                                  <select class="form-control" name="subcategory_id" id="subcategory_dropdown">
                                    <option value=" ">Select One Subcategory</option>
                                    @forelse ($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                    @empty
                                        <option value=" ">No Subcategory Here</option>
                                    @endforelse
                                  </select>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="product_weight" class="form-label">Product Weight: </label>
                                <input type="text" class="form-control" name="product_weight" id="product_weight" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="product_dimensions" class="form-label">Product Dimensions: </label>
                                <input type="text" class="form-control" name="product_dimensions" id="product_dimensions" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="product_materials" class="form-label">Product Materials: </label>
                                <input type="text" class="form-control" name="product_materials" id="product_materials" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_other_info" class="form-label">Product Other Info: </label>
                        <textarea class="form-control" name="product_other_info" id="product_other_info" rows="2"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_long_description" class="form-label">Product Long Description: </label>
                        <textarea class="form-control" name="product_long_description" id="product_long_description" rows="4"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_thumbnail_photo" class="form-label">Product Thumbnail Photo: </label>
                        <input type="file" class="form-control" name="product_thumbnail_photo" id="product_thumbnail_photo" aria-describedby="helpId">
                    </div>
                    <button class="btn btn-info btn-sm" type="submit">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_script')
    <script>
        $(document).ready(function () {
            $('#category_dropdown').select2();
            $('#subcategory_dropdown').select2();
            $('#category_dropdown').change(function(){
                var category_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'/get/subcategory',
                    data:{category_id:category_id},
                    success: function(data){
                        $('#subcategory_dropdown').html(data);
                    }
                })
            });
        });
    </script>
@endsection
