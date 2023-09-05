@extends('admin.layouts.master')
@section('title', 'Category List Page')
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
                                <h2 class="title-1">Admin List</h2>

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
                            <form action="" method="get">
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
                            <h4><i class="fas fa-database mr-2"></i> {{ $admin->total() }}</h4>
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="dataTable">

                                    @foreach ($admin as $a)
                                        <tr>
                                            <input type="hidden" name="" id="userId" value="{{ $a->id }}">
                                            <td class=" shadow-sm col-2">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/defaultUser.jpg') }}" alt=""
                                                            class=" img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('image/girl_defaultimages.png') }}"
                                                            alt="" class=" img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage./' . $a->image) }}" alt=""
                                                        class=" img-thumbnail shadow-sm">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td class="">
                                                <div class="table-data-feature row">
                                                    @if (Auth::user()->id == $a->id)
                                                    @else
                                                        <div class="row">
                                                            <div class="d-flex">

                                                                <select name="roleStatus" id="role"
                                                                    class="form-control  roleChange">
                                                                    <option value="admin"
                                                                        @if ($a->role == 'admin') selected @endif>
                                                                        Admin</option>
                                                                    <option value="user"
                                                                        @if ($a->role == 'user') selected @endif>
                                                                        User</option>
                                                                </select>


                                                                <a href="{{ route('admin#delete', $a->id) }}"
                                                                    class="mt-2">
                                                                    <button class="item ms-2 " data-toggle="tooltip"
                                                                        data-placement="top" title="Delete">
                                                                        <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </div>






                            </tbody>
                        </table>
                        <div class=" mt-3">
                            {{ $admin->links() }}
                        </div>

                    </div>

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
            $(".roleChange").change(function() {
                $roleChange = $(this).val();

                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type: "get",
                    url: "/admin/change",
                    data: {
                        'userId': $userId,
                        'roleStatus': $roleChange,


                    },
                    dataType: "json",
                })
                location.reload();
            })
        })
    </script>

@endsection
