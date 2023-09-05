@extends('user.layout.master')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4v text-center"><span
                class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-7 offset-2 mb-5 mt-3 ">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post"
                        action="{{ route('user#contact', Auth::user()->id) }}">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}">
                        <div class="control-group mb-3">
                            <input type="text"
                                class="form-control  @error('name') is-invalid

                                    @enderror"
                                name="name" placeholder="Your Name"
                                data-validation-required-message="Please enter your name"
                                value="{{ Auth::user()->name }}" />

                            @error('name')
                                <div class=" invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="control-group mb-3">
                            <input type="email"
                                class="form-control @error('email') is-invalid

                            @enderror"
                                name="email" placeholder="Your Email" required="required"
                                data-validation-required-message="Please enter your email"
                                value="{{ Auth::user()->email }}" />
                            @error('email')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="control-group mb-3">
                            <textarea class="form-control @error('message')is-invalid

                            @enderror " rows="8"
                                name="message" placeholder="Message" required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            @error('message')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>

    <script></script>
@endsection
