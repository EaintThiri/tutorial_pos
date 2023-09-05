@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- PAGE CONTAINER-->

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row ">
            <div class="col-3 offset-7 mb-2">
                @if (session('updateSuccess'))
                    <div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-times me-2"></i>{{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">





                <div class="col-lg-10 offset-1">
                    <div class="mb-3">
                        <a href="{{ route('admin#userContactList') }}" class="text-dark"><i
                                class="fa-solid fa-arrow-left me-2"></i>Back</a>
                    </div>
                    <div class="card " style="background-color:rgb(249, 245, 245);">


                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Detail</h3>
                            </div>

                            <hr>
                            <div class=" mt-4 col-8 offset-2">

                                <div class=" mt-2">
                                    <div class="row mb-4">

                                        <div class="col-6 ">
                                            <h5>
                                                <i class="fa-solid fa-user mx-1"></i>Name
                                            </h5>


                                        </div>
                                        <div class="col-6">
                                            <h5>
                                                {{ $contact->name }}</h5>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <h5><i class="fa-regular fa-envelope mx-1"></i>Email</h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>{{ $contact->email }}</h5>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <h5><i class="fa-regular fa-clock mx-1"></i>Contact Date</h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>{{ $contact->created_at->format('j-F-Y') }}</h5>
                                        </div>

                                    </div>


                                    <div class=" my-3 ">
                                        <h5><i class="fa-solid fa-file-lines mx-1 "></i>Message</h5>
                                        <textarea class="form-control mt-3" id="" cols="30" rows="10" disabled>{{ $contact->message }}</textarea>



                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
