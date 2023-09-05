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
                                <div>
                                    <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>
                                </div>
                                <h3 class="text-center title-2">Update Pizzas</h3>
                            </div>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-4">
                                    <div class="col-4 offest-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizzas->id }}">

                                        <img src="{{ asset('storage/' . $pizzas->image) }}"
                                            class=" img-thumbnail shadow-sm ">

                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage"
                                                class="form-control @error('pizzaImage') is-invalid

                                            @enderror">
                                            @error('pizzaImage')
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
                                                name="pizzaName"value=" {{ old('pizzaName', $pizzas->name) }} "
                                                type="text"
                                                class="form-control @error('pizzaName') is-invalid

                                                @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                            @error('pizzaName')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="" cols="30" rows="10"
                                                class="form-control @error('pizzaDescription') is-invalid

                                           @enderror"
                                                placeholder="Enter Pizza Description">{{ old('pizzaDescription', $pizzas->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control @error('pizzaCategory') is-invalid
                                            @enderror">
                                                <option value="">Chooser Pizza Category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizzas->category_id == $c->id) selected @endif>
                                                        {{ $c->name }} </option>
                                                @endforeach

                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament"
                                                name="pizzaPrice"value=" {{ old('pizzaPrice', $pizzas->price) }} "
                                                type="integer"
                                                class="form-control  @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('pizzaPrice')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament"
                                                name="pizzaWaitingTime"value=" {{ old('pizzaWaitingTime', $pizzas->waiting_time) }} "
                                                type="integer"
                                                class="form-control  @error('pizzaWaitingTime') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('pizzaWaitingTime')
                                                <div class=" invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input id="cc-pament"
                                                name="viewCount"value=" {{ old('viewCount', $pizzas->view_count) }} "
                                                type="integer" class="form-control " disabled aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone">


                                        </div>





                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament"
                                                name="created_at"value=" {{ old('created_at', $pizzas->created_at->format('j-F-Y')) }} "
                                                type="integer"
                                                class="form-control  @error('created_at')


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
