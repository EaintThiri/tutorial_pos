@extends('admin.layouts.master')
@section('title', 'Product List Page')
@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                {{-- <h2 class="title-1"> Order List</h2> --}}

                            </div>
                        </div>

                    </div>



                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check"></i>{{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif




                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-times"></i>{{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4>Search Key:: <span class="text-danger">{{ request('key') }}</span></h4>

                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('order#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."
                                        value={{ request('key') }}>
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>




                    <form action="{{ route('admin#changeStatus') }}" method="get">
                        @csrf
                        {{-- <div class="d-flex"> --}}


                        <div class="input-group mt-3">
                            <label for="" class="mt-1 me-3">Order Status</label>
                            <select name="status" class="form-select col-2" id="inputGroupSelect02">
                                <option value="">All</option>
                                <option value="0" @if (request('status') == '0') selected @endif>Pending
                                </option>
                                <option value="1" @if (request('status') == '1') selected @endif>Accept</option>
                                <option value="2" @if (request('status') == '2') selected @endif>Reject</option>
                            </select>
                            <div class="input-group-appens">
                                {{-- <label class="input-group-text" for="inputGroupSelect02">Options</label> --}}
                                <button class="btn input-group-text btn-sm bg-dark text-white ms-2 orderStatus"
                                    type="submit"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                            </div>

                            <div class="input-group mb-3">
                                <div class=" col-1 offset-10 bg-white shadow-sm p-2 text-center mt-2">
                                    <h4><i class="fas fa-database me-2"></i>{{ count($order) }}</h4>
                                </div>
                            </div>
                        </div>




                        {{-- </div> --}}
                    </form>


                    @if (count($order) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>

                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Order Code</th>
                                        <th>Order Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($order as $o)
                                        <tr class="tr-shadom">
                                            <input type="hidden" name="" id="orderId" value="{{ $o->id }}">
                                            <input type="hidden" name="" id="userId" value="{{ $o->user_id }}">
                                            <td class="">{{ $o->user_id }}</td>
                                            <td class="" id="userName">{{ $o->userName }}
                                            </td>
                                            <td class="">
                                                <a
                                                    href="{{ route('admin#listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                            </td>
                                            <td class="">{{ $o->created_at->format('F-j-Y') }}</td>
                                            <td class="amount">{{ $o->total_price }} kyats</td>
                                            <td class="">
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0" @if ($o->status == 0) selected @endif
                                                        class=text-warning>Pending</option>
                                                    <option value="1" @if ($o->status == 1) selected @endif
                                                        class=text-success>Accept</option>
                                                    <option value="2" @if ($o->status == 2) selected @endif
                                                        class=text-danger>Reject</option>
                                                </select>
                                            </td>
                                            <td>
                                                @if ($o->userName == null)
                                                    <button class="btn btn-sm deleteBtn">
                                                        <i class="fa-solid fa-trash me-2"></i>Delete
                                                    </button>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class=" mt-3">
                            {{ $order->links() }}
                        </div> --}}

                        </div>
                    @else
                        <div class="text-center mb-3">
                            <h3>There is no Order List</h3>
                        </div>

                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $("#orderStatus").change(function() {
                $orderStatus = $("#orderStatus").val();
                // $orderStatus = "";
                // switch ($status) {
                //     case "0":
                //         $orderStatus = 0;
                //         break;
                //     case "1":
                //         $orderStatus = 1;
                //         break;
                //     case "2":
                //         $orderStatus = 2;
                //         break;
                //     default:
                //         $orderStatus = "";
                //         break;
                // }
                $.ajax({
                    type: "get",
                    url: "/order/ajax/status",
                    data: {
                        "status": $orderStatus
                    },
                    dataType: "json",
                    success: function(response) {

                        //append
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {


                            $month = ['January', 'February', 'Match', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November',
                                'December'
                            ];
                            $dbDate = new Date(response[$i].created_at);
                            $finalDate = $month[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
                                "-" + $dbDate.getFullYear();

                            if (response[$i].status == 0) {
                                $statusMessage = ` <select name="status" class="form-control statusChange">

                                            <option value="0" selected>Pending</option>
                                            <option value="1" >Accept</option>
                                            <option value="2" >Reject</option>
                                        </select>`;
                            } else if (response[$i].status == 1) {
                                $statusMessage = ` <select name="status" class="form-control statusChange">
                                            <option value="0" >Pending</option>
                                            <option value="1" selected>Accept</option>
                                            <option value="2" >Reject</option>
                                        </select>`;
                            } else if (response[$i].status == 2) {
                                $statusMessage = ` <select name="status" class="form-control statusChange">
                                            <option value="0" >Pending</option>
                                            <option value="1" >Accept</option>
                                            <option value="2" selected>Reject</option>
                                        </select>`;
                            }

                            $list += `<tr class="tr-shadom">
                                 <input type="hidden" name="" id="orderId" value="${response[$i].id}">
                                    <td class=""> ${response[$i].user_id}</td>
                                    <td class=""> ${response[$i].userName}</td>
                                    <td class=""> ${response[$i].order_code }</td>
                                    <td class=""> ${$finalDate} </td>
                                    <td class=""> ${response[$i].total_price }</td>
                                    <td class="">${$statusMessage}</td>

                                </tr>
                    `;
                        }
                        $('#dataList').html($list);

                    }
                })
            });

            //change status
            $('.statusChange').change(function() {

                $currenStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                //$totalAmount = $parentNode.find(".amount").html();
                $orderId = $parentNode.find("#orderId").val();

                $data = {
                    "status": $currenStatus,
                    "orderId": $orderId
                }

                $.ajax({
                    type: "get",
                    url: "/order/ajax/change/status",
                    data: $data,
                    dataType: 'json',

                })


            })

            $('.deleteBtn').click(function() {
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                $userName = $parentNode.find('#userName').html();


                $.ajax({
                    type: 'get',
                    url: '/order/delete',
                    data: {
                        'userId': $userId
                    },
                    dataType: 'json',

                })
                $parentNode.remove();
            })


        })
    </script>

@endsection
