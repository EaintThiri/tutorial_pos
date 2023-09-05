@extends('user.layout.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">

            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <th class="thead-dark">
                        <thead>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </thead>
                    </th>
                    <tbody class="align-middle" id="dataTable">
                        @foreach ($cartList as $c)
                            <tr>
                                {{-- <input type="hidden" id="price" value="{{ $c->pizza_price }}"> --}}

                                <td><img src="{{ asset('storage/' . $c->product_image) }}" alt=""
                                        style="width: 100px;" class=" img-thumbnail"></td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }}
                                    <input type="hidden" value="{{ $c->id }}" id="orderId">
                                    <input type="hidden" value="{{ $c->product_id }}" id="productId">
                                    <input type="hidden" value="{{ $c->user_id }}" id="userId">

                                </td>


                                <td class="align-middle" id="pizzaPrice">{{ $c->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center"
                                            id="qty" value="{{ $c->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} kyats</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger btnRemove">
                                        <i class="fa fa-times"></i></button>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Sub Total</h6>
                            <h5 id='subTotalPrice'>{{ $totalPrice }} kyats</h5>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h5 class="font-weight-medium">2000 kyats</h5>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id='finalPrice'>{{ $totalPrice + 2000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkOut">Proceed To
                            Checkout</button>

                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>

    <script>
        $('#checkOut').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 100001);

            $('#dataTable tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    "product_id": $(row).find('#productId').val(),
                    "qty": $(row).find('#qty').val(),
                    "total": $(row).find("#total").text().replace("kyats", "") * 1,
                    "order_code": "POS" + "0000" + $random
                });

            });
            $.ajax({
                type: 'get',
                url: "http://127.0.0.1:8000/user/ajax/order",
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == "true") {
                        window.location.href = "/user/home";
                    }
                }
            })
        });

        $('#clearBtn').click(function() {
            $('#dataTable tr').remove();
            $('#subTotalPrice').html("0 kyats");
            $('#finalPrice').html("0 Kyats")
            console.log("clear");

            //clear database
            $.ajax({
                type: "get",
                url: "/user/ajax/clear/cart",
                dataType: 'json',


            })


        });

        //remove current cart
        $('.btnRemove').click(function() {
            $parentNode = $(this).parents("tr");
            $productId = $parentNode.find("#productId").val();
            $orderId = $parentNode.find("#orderId").val();

            $.ajax({
                type: "get",
                url: "/user/ajax/clear/product",
                data: {
                    'productId': $productId,
                    'id': $orderId
                },
                dataType: "json",
            })
            $parentNode.remove();

            $totalPrice = 0;
            $("#dataTable tr").each(function(index, row) {
                $totalPrice += Number($(row).find("#total").text().replace("kyats", ""));
            })

            $("#subTotalPrice").html(`${$totalPrice} kyats`);
            $("#finalPrice").html(`${$totalPrice+2000} kyats`);


        });
    </script>
@endsection
