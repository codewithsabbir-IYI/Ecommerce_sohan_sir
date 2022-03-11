@extends('layouts.app_frontend');

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('cart.item.all.update') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_amount = 0;
                                        $order_button = true;
                                    @endphp

                                    @forelse ($carts as $cart)

                                        <tr>

                                            <td class="product-thumbnail">
                                                <a href="#"><img style="width: 80%" class="img-responsive ml-15px"
                                                        src="{{asset('frontend/uploads/product_thumbnail_photo')}}/{{$cart->realtionwithProduct->product_thumbnail_photo}}" alt="" />
                                                </a>
                                            </td>
                                            <td class="product-name ">
                                                <a href="#">
                                                    {{$cart->realtionwithProduct->product_name}}
                                                </a>
                                                <p>
                                                    Color:
                                                    <span style="background-color: {{$cart->realtionwithColor->color_code}}" class="badge rounded-circle">&nbsp;</span> </br>
                                                    Size: <span> {{$cart->realtionwithSize->size_name}} </span>
                                                </p>
                                            </td>

                                            <td class="product-price-cart">
                                                <span class="amount">
                                                    @if ($unit_prise =  $cart->realtionwithProduct->product_discounted_price)
                                                        {{ $cart->realtionwithProduct->product_discounted_price }}
                                                    @else

                                                        {{$unit_prise = $cart->realtionwithProduct->product_regular_price }}
                                                    @endif

                                                </span>


                                            </td>

                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="cart_item[{{$cart->id}}]"
                                                        value="{{$product_user_amount = $cart->user_input_amount}}" />
                                                        @if (avaiable_stock( $cart->product_id, $cart->color_id, $cart->size_id) < $product_user_amount = $cart->user_input_amount)
                                                            <span class="badge bg-danger" >Out Of Stock</span>
                                                            <span class="badge bg-info" >Available: {{avaiable_stock( $cart->product_id, $cart->color_id, $cart->size_id)}}</span>

                                                            <?php
                                                                $order_button = false;
                                                            ?>
                                                        @endif
                                                </div>
                                            </td>
                                            <td class="product-subtotal">{{ $subtotal_prise = $unit_prise * $product_user_amount}}</td>
                                            <td class="product-remove">
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('remove.cart',$cart->id)}} "><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $total_amount += $subtotal_prise;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-bold">Your Cart Item Is Empty</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{route('shop')}}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        <a href="{{route('clear.cart')}}">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Region / State
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select mb-25px">
                                            <label>
                                                * Zip/Postal Code
                                            </label>
                                            <input type="text" />
                                        </div>
                                        <button class="cart-btn-2" type="submit">Get A Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" required="" name="name" />
                                        <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total products <span>{{$total_amount}}</span></h5>
                                <div class="total-shipping">
                                    <h5>Total shipping</h5>
                                    <ul>
                                        <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                        <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                    </ul>
                                </div>
                                <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                                @if ($order_button)
                                <a href="checkout.html">Proceed to Checkout</a>

                                @else
                                    <div class="alert alert-danger">
                                        Please Check Stock Out Product
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection
