@extends('front.master')

@section('title', 'Contact | ' . env('APP_NAME'))

@section('styles')

<style>

.contact-form form input, .contact-form form textarea {
    margin-bottom: 0;
}

</style>

@stop

@section('content')

@include('front.parts.inner-hero')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+01-3-8888-6868</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>60-49 Road 11378 New York</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>10:00 am to 23:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>hello@colorlib.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>New York</h4>
                <ul>
                    <li>Phone: +12-345-6789</li>
                    <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div id="{{ $errors->any() ? 'has-error' : '' }}" class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            {{-- @include('admin.errors') --}}
            <form action="{{ route('site.contactus') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <input type="text" name="name" placeholder="Your name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <input type="text" name="email" placeholder="Your Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <textarea placeholder="Your message" name="message" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <div class="text-right mt-4">
                            <button type="submit" class=" w-25 site-btn">SEND MESSAGE</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
@stop

@section('scripts')

<script>
    if($('#has-error').length > 0) {
        $('html, body').animate({
            scrollTop: $('#has-error').offset().top
        }, 1000)
    }

</script>

@stop
