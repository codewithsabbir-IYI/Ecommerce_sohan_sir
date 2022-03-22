@extends('dashboard.dashboard_master');
@section('page_title')
Shipping Charge
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Add Sub Shipping Charge
            </div>
            <div class="card-body">

                <form action="{{ route('add.shipping') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="country-id" class="form-label">Country Name</label>
                        <div class="mb-3">
                          <select class="form-control" name="country_id">
                            <option>-Select Your Country-</option>
                            @forelse ($countries as $country)
                            <option value=" {{$country->id}} ">{{$country->country_name}}</option>
                            @empty
                            <option>No Data To Show</option>
                            @endforelse

                          </select>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="city_name" class="form-label">State/City Name</label>
                        <input type="text"
                          class="form-control" name="city_name" id="city_name" aria-describedby="helpId" placeholder="">

                    </div>
                    <div class="mb-3">
                        <label for="shipping_charge" class="form-label">Shipping Charge</label>
                        <input type="text"
                          class="form-control" name="shipping_charge" id="shipping_charge" aria-describedby="helpId" placeholder="">

                    </div>

                    <button class="btn btn-info btn-sm" type="submit">Add Shipping Charge</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Shipping Charge
            </div>
            <div class="card-body">
                <table class="table table-bordered ">
                    <thead class="thead-default">
                        <tr>
                            <th>Country</th>
                            <th>City</th>
                            <th>Charge</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipping_charges as $shipping_charge)
                            <tr>
                                <td scope="row">{{ $shipping_charge->retationwithcountry->country_name }}</td>
                                <td>{{ $shipping_charge->city_name }}</td>
                                <td>{{ $shipping_charge->shipping_charge }}</td>
                            </tr>

                            @empty
                                <tr>
                                    <td>No Data To Show</td>
                                </tr>
                            @endforelse

                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
