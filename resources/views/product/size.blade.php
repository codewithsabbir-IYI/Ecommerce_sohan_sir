@extends('dashboard.dashboard_master');
@section('page_title')
Add Size
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Add Size
            </div>
            <div class="card-body">

                <form action=" {{ route('product.size.store')}} " method="POST" >
                    @csrf
                    <div class="mb-3">
                      <label for="size_name" class="form-label">Size Name</label>
                      <input type="text"
                        class="form-control" name="size_name" id="size_name" aria-describedby="helpId">

                    </div>
                    <button class="btn btn-info btn-sm" type="submit">Add Size</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                View Size
            </div>
            <div class="card-body">
                <table class="table table-bordered table-inverse ">
                    <thead class="thead-inverse|thead-default">
                        <tr>
                            <th>Size Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($sizes as $size)
                                <tr>
                                    <td scope="row">{{$size->size_name}}</td>
                                </tr>
                            @empty
                                No Size to show
                            @endforelse

                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
