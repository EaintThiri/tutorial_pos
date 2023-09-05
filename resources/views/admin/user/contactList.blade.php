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
                                <h2 class="title-1"> Contact List</h2>

                            </div>
                        </div>

                    </div>



                    {{-- @if (session('createSuccess'))
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
                    @endif --}}




                    @if (count($userContact) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($userContact as $uc)
                                        <tr class="tr-shadom">
                                            <input type="hidden" class="contactId" value={{ $uc->id }}>
                                            <td>{{ $uc->name }}</td>
                                            <td>{{ $uc->email }}</td>
                                            <td>{{ $uc->message }}</td>
                                            <td>{{ $uc->created_at->format('F-j-Y') }}</td>

                                            <td class="d-flex">
                                                <div>
                                                    <button class="btn btn-sm">
                                                        <a href="{{ route('user#detailPage', $uc->id) }}" class="text-dark">
                                                            <i class="fa-solid fa-circle-info me-1"></i>Detail
                                                        </a>

                                                    </button>


                                                </div>

                                                <div>
                                                    <button class="btn btn-sm delete">
                                                        <i class="fa-solid fa-trash me-1"></i>Delete
                                                    </button>
                                                </div>

                                            </td>




                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>




                        </div>
                    @else
                        <div class="text-center mb-3">
                            <h3>There is no User Contact List</h3>
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
            $('.delete').click(function() {

                $parentNode = $(this).parents('tr');
                $contactId = $parentNode.find(".contactId").val();
                $.ajax({
                    type: 'get',
                    url: '/contact/delete',
                    data: {
                        'contactId': $contactId
                    },
                    dataType: 'json'
                })
                $parentNode.remove();
            })

        })
    </script>

@endsection
