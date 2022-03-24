@extends('dashboard.dashboard_master');
@section('page_title')
Coupon Maneger
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                Add Coupon
            </div>
            <div class="card-body">

                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="coupon_type" class="form-label">Coupon Type</label>
                        <div class="mb-3">
                          <select class="form-control" name="coupon_type">
                            <option>-Select Coupon Type-</option>
                            <option value='1'>Percentage (%)</option>
                            <option value='2'>Flat Discount</option>

                          </select>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="coupon_name" class="form-label">Coupon Name</label>
                        <input type="text"
                          class="form-control" name="coupon_name" id="coupon_name" aria-describedby="helpId" placeholder="">

                    </div>
                    <div class="mb-3">
                        <label for="discount_amount" class="form-label">Discount Amount</label>
                        <input type="number"
                          class="form-control" name="discount_amount" id="discount_amount" aria-describedby="helpId" placeholder="">

                    </div>
                    <div class="mb-3">
                        <label for="coupon_limit" class="form-label">Coupon Limit</label>
                        <input type="number"
                          class="form-control" name="coupon_limit" id="coupon_limit" aria-describedby="helpId" placeholder="">

                    </div>
                    <div class="mb-3">
                        <label for="coupon_validity" class="form-label">Coupon Validity</label>
                        <input type="date"
                          class="form-control" name="coupon_validity" id="coupon_validity" aria-describedby="helpId" placeholder="" min="{{ \Carbon\Carbon::today()->format('Y-m-d')}}"/>

                    </div>

                    <button class="btn btn-info btn-sm" type="submit">Add Coupon</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                Coupon
            </div>
            <div class="card-body">
                <table class="table table-bordered ">
                    <thead class="thead-default">
                        <tr>
                            <th>Discount Type</th>
                            <th>Name</th>
                            <th>Discount Amount</th>
                            <th>Limit</th>
                            <th>Validity</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->coupon_type}}</td>
                                    <td>{{ $coupon->coupon_name}}</td>
                                    <td>{{ $coupon->discount_amount}}{{ ($coupon->coupon_type == 1)? '%': 'TK' }}</td>
                                    <td>{{ $coupon->coupon_limit}}</td>
                                    <td>{{ $coupon->coupon_validity}}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
