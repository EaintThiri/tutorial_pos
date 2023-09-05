@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title ">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-4">
                                    <div class="col-4 offest-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/defaultUser.jpg') }}" alt=""
                                                    class=" img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/girl_defaultimages.png') }}" alt=""
                                                    class=" img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class=" img-thumbnail shadow-sm" />
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid

                                            @enderror">
                                            @error('image')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3 ">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fas fa-arrow-right me-2"></i>Update</button>
                                        </div>
                                    </div>
                                    <div class=" col-6 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament"
                                                name="name"value=" {{ old('name', Auth::user()->name) }} " type="text"
                                                class="form-control @error('name') is-invalid

                                                @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament"
                                                name="email"value=" {{ old('email', Auth::user()->email) }} "
                                                type="text"
                                                class="form-control  @error('email') is-invalid


                                                @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament"
                                                name="phone"value=" {{ old('phone', Auth::user()->phone) }} "
                                                type="text" class="form-control  @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid


                                            @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>

                                                    Female </option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address"
                                                class="form-control @error('address') is-invalid

                                            @enderror"
                                                cols="30" rows="10" placeholder="Enter Admin address">{{ old('address', Auth::user()->address) }}</textarea>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input id="cc-pament"
                                                name="role"value=" {{ old('role', Auth::user()->role) }} "
                                                type="text"
                                                class="form-control  @error('role')


                                                @enderror"
                                                aria-required="true" aria-invalid="false" disabled>

                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
