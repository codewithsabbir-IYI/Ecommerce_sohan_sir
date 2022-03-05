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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Shop Page Start  -->
<div class="shop-category-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                <!-- Shop Top Area Start -->
                <div class="shop-top-bar d-flex">
                    <!-- Left Side start -->
                    <p><span>{{$products->count()}}</span> Product Found of <span>{{$total_search_product}}</span></p>
                    <!-- Left Side End -->
                    <div class="shop-tab nav">
                        <a class="active" href="#shop-grid" data-bs-toggle="tab">
                            <i class="fa fa-th" aria-hidden="true"></i>
                        </a>
                    </div>
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>Sort By:</p>
                        </div>
                        <div class="shop-select">
                            <select class="shop-sort">
                                <option data-display="Best Match">Best Match</option>
                                <option value="1"> Name, A to Z</option>
                                <option value="2"> Name, Z to A</option>
                                <option value="3"> Price, low to high</option>
                                <option value="4"> Price, high to low</option>
                            </select>

                        </div>
                    </div>
                    <!-- Right Side End -->
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area">

                    <!-- Tab Content Area Start -->
                    <div class="row">
                        <div class="col">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="shop-grid">
                                    <div class="row mb-n-30px">

                                        <!-- Prodects -->
                                        @forelse ($products as $product)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px"             data-aos="fade-up"data-aos-delay="200">
                                                @include('parts.product_thumbnail')
                                            </div>
                                        @empty
                                            <p>No Product To show</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content Area End -->

                    <!--  Pagination Area Start -->
                    <div class="load-more-items text-center mb-md-60px mb-lm-60px mt-30px0px" data-aos="fade-up">
                        <a href="#" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                                class="fa fa-refresh ml-15px" aria-hidden="true"></i></a>
                    </div>
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-md-60px mb-lm-60px">
                <div class="shop-sidebar-wrap">
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget-search">
                        <form id="widgets-searchbox" action=" ">
                            <input class="input-field" type="text" placeholder="Search" name="search_string" value="{{ isset($_GET['search_string']) ? $_GET['search_string']: ''}} ">
                            <button class="widgets-searchbox-btn" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Sidebar single item -->
                    <form action=" ">
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control " type="text" placeholder="Min " name="min" >
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Max " name="max" >
                            </div>
                            <button class="btn btn-primary blog-btn mt-2" type="submit">Search</button>
                        </div>
                    </form>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-title">Category</h4>
                        <div class="sidebar-widget-category">
                            <ul>
                                <li><a href="#" class="selected m-0">Accesasories <span>(6)</span> </a></li>
                                <li><a href="#" class="">Computer <span>(4)</span> </a></li>
                                <li><a href="#" class="">Covid-19 <span>(2)</span> </a></li>
                                <li><a href="#" class="">Electronics <span>(6)</span> </a></li>
                                <li><a href="#" class="">Frame Sunglasses <span>(12)</span> </a></li>
                                <li><a href="#" class="">Furniture <span>(7)</span> </a></li>
                                <li><a href="#" class="">Genuine Leather <span>(9)</span> </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-title">Color</h4>
                        <div class="sidebar-widget-list color">
                            <ul>
                                <li><a class="active yellow" href="#"></a></li>
                                <li><a class="black" href="#"></a></li>
                                <li><a class="red" href="#"></a></li>
                                <li><a class="pink" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-title">Size</h4>
                        <div class="sidebar-widget-list size">
                            <ul>
                                <li><a class="active-2 gray" href="#">S</a></li>
                                <li><a class="gray" href="#">M</a></li>
                                <li><a class="gray" href="#">L</a></li>
                                <li><a class="gray" href="#">XL</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget tag">
                        <h4 class="sidebar-title">Tags</h4>
                        <div class="sidebar-widget-tag">
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Organic</a></li>
                                <li><a href="#">Old Fashion</a></li>
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Dress</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Page End  -->
@endsection
