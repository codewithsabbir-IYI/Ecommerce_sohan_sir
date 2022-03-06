@extends('dashboard.dashboard_master');
@section('page_title')
Add Color
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Add Color
            </div>
            <div class="card-body">

                <form action=" {{ route('product.color.store')}} " method="POST" >
                    @csrf
                    <div class="mb-3">
                      <label for="color_name" class="form-label">Color Name</label>
                      <input type="text"
                        class="form-control" name="color_name" id="color_name" aria-describedby="helpId">

                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color"
                          class=" " name="color_code" id="color_code" aria-describedby="helpId" placeholder="">
                      </div>
                    <button class="btn btn-info btn-sm" type="submit">Add Color</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                View Color
            </div>
            <div class="card-body">
                <table class="table table-bordered table-inverse ">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>Color Name</th>
                            <th>Color Code</th>

                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)
                                <tr>
                                    <td scope="row">{{$color->color_name}}</td>
                                    <td>
                                        <span class="badge" style="background-color: {{$color->color_code}}">&nbsp;&nbsp;&nbsp;</span>
                                    </td>
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
