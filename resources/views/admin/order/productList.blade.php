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

                                <a href="{{ route('order#list') }}" class="text-dark"><i
                                        class="fa-solid fa-arrow-left me-2"></i>Back</a>


                            </div>




                        </div>
                    </div>


                    <div class="card mt-4 col-5">
                        <div class="card-header mt-2">
                            <h3><i class="fa-solid fa-receipt me-2"></i>Order Info</h3>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row mb-3">
                                <div class="col-6 "> <i class="fa-solid fa-user mx-2"></i>Name</div>
                                <div class="col-6">{{ strtoupper($orderList[0]->userName) }}</div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-6"> <i class="fa-solid fa-barcode mx-2"></i>Order Code</div>
                                <div class="col-6">{{ $orderList[0]->order_code }}</div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-6"> <i class="fa-regular fa-clock mx-2"></i>Order Date</div>
                                <div class="col-6">{{ $orderList[0]->created_at->format('j_F-Y') }}</div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-6"><i class="fa-solid fa-money-bill mx-2"></i>Total</div>
                                <div class="col-6">{{ $order->total_price }} kyats</div>

                            </div>
                            <div class="row ">
                                <div class="col-5"></div>
                                <small class="col-6 text-danger">(<i class="fa-solid fa-circle-exclamation mx-2"></i>Include
                                    Delivery Fees )</small>

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

                    {{-- <div class="row">
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
                    </div> --}}

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr style=" background-color:rgb(247, 241, 241);">
                                    <th></th>
                                    <th>Order Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>quantity</th>
                                    <th>Amount</th>


                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($orderList as $o)
                                    <tr class="tr-shadom">
                                        {{-- <input type="hidden" name="" id="orderId" value="{{ $o->id }}"> --}}
                                        <td></td>
                                        <td class="">{{ $o->id }}</td>
                                        <td class="col-2"><img src="{{ asset('storage/' . $o->productImage) }}"
                                                alt="" class=" img-thumbnail " style="height:100px;"></td>

                                        <td>{{ $o->productName }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td class="amount">{{ $o->total }} kyats</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class=" mt-3">
                            {{ $order->links() }}
                        </div> --}}

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
