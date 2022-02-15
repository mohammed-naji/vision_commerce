@extends('front.master')

@section('title', 'Checkout | ' . env('APP_NAME'))

@section('content')
    @include('front.parts.inner-hero')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('site.home') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div> --}}
            <div class="checkout__form">
                <h4>Billing Details</h4>

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $checkoutId }}"></script>
                        <form action="{{ route('site.thanks') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            @php
                                $subtotal = 0;
                            @endphp
                            <ul>
                                @foreach ($carts as $cart)
                                <li>{{ $cart->product->name }} <span>${{ $cart->quantity * $cart->price }}</span></li>
                                @php
                                    $subtotal += $cart->quantity * $cart->price;
                                @endphp
                                @endforeach

                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>${{ $subtotal }}</span></div>
                            <div class="checkout__order__total">Total <span>${{ $subtotal }}</span></div>
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Create an account?
                                    <input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Check Payment
                                    <input type="checkbox" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}
                            {{-- <button type="submit" class="site-btn">PLACE ORDER</button> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@stop
