@extends('dashboard.dashboard_master');
@section('page_title')
Add Inventory
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Add Inventory
            </div>
            <div class="card-body">

                <form action=" {{ route('product.add.inventory.post', $product->id)}} " method="POST" >
                    @csrf
                    <div class="mb-3">
                      <label for="color_name" class="form-label">Color Name</label>
                      <select name="color_id" id="" class="form-control">
                          <option value="">-Select One Color-</option>
                          @foreach ($colors as $color)
                          <option value="{{ $color->id }}">{{ $color->color_name }} <span style="background-color: {{$color->color_code}}"> &nbsp;&nbsp;</span></option>

                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="size_name" class="form-label">Size Name</label>
                      <select name="size_id" id="size_name" class="form-control">
                          <option value="">-Select One  Size-</option>
                          @foreach ($sizes as $size)
                          <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                       <input type="text" class="form-control" name="quantity">
                      </div>
                    <button class="btn btn-info btn-sm" type="submit">Add Inventory</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
              <h4>Product Name: {{$product ->product_name }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-inverse ">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>SL: </th>
                            <th>Color Name</th>
                            <th>Size Name</th>
                            <th>Quantity</th>

                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $inventory)
                                <tr>
                                    <td></td>
                                    <td scope="row">
                                        {{$inventory->realtionwithColor->color_name}} -
                                        <span style="background-color:  {{$inventory->realtionwithColor->color_code}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                                    </td>
                                    <td scope="row">{{$inventory->realtionwithSize->size_name}}</td>
                                    <td scope="row">{{$inventory->quantity}}</td>

                                </tr>
                            @empty
                                No Color to show
                            @endforelse

                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
