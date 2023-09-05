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
                                <h2 class="title-1"> User List</h2>

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




                    @if (count($users) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th> Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($users as $user)
                                        <tr class="tr-shadom">
                                            <input type="hidden" name="" id="userId" value="{{ $user->id }}">
                                            <td>{{ $user->id }}</td>
                                            <td class=" col-2">
                                                @if ($user->image == null)
                                                    @if ($user->gender == 'male')
                                                        <img src="{{ asset('image/defaultUser.jpg') }}" alt=""
                                                            class=" img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('image/girl_defaultimages.png') }}"
                                                            alt="" class=" img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt=""
                                                        class=" img-thumbnail shadow-sm">
                                                @endif
                                            </td>
                                            <td> {{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>

                                                <select name="role" id="role" class="btnClick">
                                                    <option value="user"
                                                        @if ($user->role == 'user') selected @endif>
                                                        User</option>
                                                    <option value="admin"
                                                        @if ($user->role == 'admin') selected @endif>
                                                        Admin</option>
                                                </select>

                                            </td>
                                            <td><i class="fa-solid fa-trash-can fs-5 deleteUser"></i></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class=" mt-3">
                                {{ $users->links() }}
                            </div>

                        </div>
                    @else
                        <div class="text-center mb-3">
                            <h3>There is no User List</h3>
                        </div>

                    @endif

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
            $('.btnClick').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();


                $.ajax({
                    type: "get",
                    url: "/user/list/page",
                    data: {
                        "role": $currentRole,
                        "userId": $userId

                    },
                    dataType: "json",

                })
                location.reload();
            })
            $(".deleteUser").click(function() {
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type: "get",
                    url: "/user/delete/page",
                    data: {

                        "userId": $userId

                    },
                    dataType: "json",

                })
                location.reload();
            })



        })
    </script>

@endsection
