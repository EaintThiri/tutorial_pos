@extends('user.layout.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                {{-- <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav> --}}
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid" style="height:500px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>

                    @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                            <td class="align-middle">{{ $o->order_code }}</td>
                            <td class="align-middle">{{ $o->total_price }}</td>

                            <td class="align-middle">
                                @if ($o->status == 0)
                                    <span class="text-warning"><i class="fa-regular fa-clock me-2"></i>Pending</span>
                                @elseif($o->status == 1)
                                    <span class="text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                @elseif($o->status == 2)
                                    <span class="text-danger"><i
                                            class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div class="mt-4">{{ $order->links() }}</div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>

    <script></script>
@endsection
