@extends('user.layout.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="label mt-2 " for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>

                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#home', null) }}" class="text-dark">
                                <label class="-label" for="price-1">All </label>
                            </a>

                        </div>


                        @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3">

                                <a href="{{ route('user#filterPage', $c->id) }}" class="text-dark">
                                    <label class="-label" for="price-1">{{ $c->name }} </label>
                                </a>

                            </div>
                        @endforeach

                    </form>
                </div>

                <div class="">
                    <button class="btn btn-warning w-100">Order</button>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>



                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-cart-plus me-2"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($cart) }}

                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#history') }}" class="ms-3">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>History
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($history) }}

                                        </span>
                                    </button>
                                </a>

                            </div>




                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button> --}}
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Ascending</a>
                                        <a class="dropdown-item" href="#">Descending</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> --}}

                                    <select name="sorting" id="sortingOption" class=" form-control">
                                        <option value="">Choose Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row" id="data">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:230px"
                                                src="{{ asset('storage./' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#cartList') }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetail', $p->id) }}"><i
                                                        class=" fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center  text-white bg-dark col-6 offset-3 py-5 fs-1">There is no Pizza</h3>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                console.log($eventOption);

                if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',

                        data: {
                            'status': 'desc'
                            // 'message': 'this is message'
                        },
                        dataType: 'json',
                        success: function(response) {

                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height:230px"
                                        src="{{ asset('storage./${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class=" fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>

                                    </div>

                                </div>
                            </div>
                        </div>`;
                            }
                            $(
                                '#data'
                            ).html($list);

                        }
                    })

                } else if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += ` <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:230px"
                                            src="{{ asset('storage./${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class=" fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>

                                        </div>

                                    </div>
                                </div>
                            </div>`;
                            }
                            $('#data').html($list);
                        }


                    })

                }
            })
        });
    </script>
@endsection
