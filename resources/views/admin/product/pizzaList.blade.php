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
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>
                                    Add Item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                            <form action="{{ route('product#list') }}" method="get">
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


                    <div class="row  mt-2">
                        <div class=" col-1 offset-10 bg-white shadow-sm p-2 text-center mt-2">
                            <h4><i class="fas fa-database mr-2"></i>{{ $pizzas->total() }}</h4>
                        </div>
                    </div>

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadom">
                                            <td class="col-2">
                                                <img src="{{ asset('storage/' . $p->image) }}"
                                                    class=" img-thumbnail shadow-sm">
                                            </td>
                                            <td class="col-3">{{ $p->name }}</td>
                                            <td class="col-2">{{ $p->price }}</td>
                                            <td class="col-2">{{ $p->category_name }}</td>
                                            <td class="col-2"> <i class="fas fa-eye me-2"></i>{{ $p->view_count }}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fas fa-eye me-2"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit me-2"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete me-2"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class=" text-secondary text-center mt-5">There is no Item Here</h3>
                    @endif
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
