@extends('front.master')

@section('title', $product->name . ' | ' . env('APP_NAME'))

@section('content')
    @include('front.parts.inner-hero')

    <h1>{{ $product->id }}</h1>
    {{-- @dump($product->category->image) --}}
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg"
        data-setbg="{{ $product->category->image ? $product->category->image : $product->image }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('site.home') }}">Home</a>
                            <a
                                href="{{ route('site.category_single', $product->category->slug) }}">{{ $product->category->name }}</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ $product->image }}" alt="">
                        </div>
                        @if ($product->album)
                            @php
                                $images = explode(',', $product->album);
                            @endphp
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($images as $img)
                                    <img data-imgbigurl="{{ $img }}" src="{{ $img }}" alt="">
                                @endforeach

                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        @if ($product->rates->count())
                            <div class="product__details__rating">
                                @php$rating = $product->rates->avg('rate');
                                    $star_count = floor($rating);
                                    $fraction = $rating - $star_count;
                                @endphp
                                @foreach (range(1, $star_count) as $i)
                                    <i class="fa fa-star"></i>
                                @endforeach

                                @if ($fraction == 0)
                                    <i class="fa fa-star-o"></i>
                                @elseif ($fraction > 0.5)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-half-o"></i>
                                @endif

                                @foreach (range(1, 4 - $star_count) as $i)
                                    <i class="fa fa-star-o"></i>
                                @endforeach

                                <span>({{ $product->rates->count() }} reviews)</span>
                            </div>
                        @endif

                        <div class="product__details__price">${{ $product->price }}</div>

                        <form class="d-inline" action="{{ route('site.purchase_product', $product->id) }}" method="POST">
                            {{-- <input type="hidden" name="product" value="{{ $product->id }}" /> --}}
                             @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                            @if (Auth::check())
                                <button class="site-btn primary-btn">ADD TO CARD</button>
                            @else
                                <a href="{{ route('login') }}" class="primary-btn">ADD TO CARD</a>
                            @endif

                        </form>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>
                                    {{ $product->quantity ? 'In Stock' : 'Out of Stock' }}
                                </span></li>

                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/sharer.php?u={{ request()->url() }}
                                        "><i class="fa fa-facebook"></i></a>
                                    <a href="https://twitter.com/share?url={{ request()->url() }}&text={{ $product->name }}&via=mohnaji94&hashtags=one,two,three
                                        "><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{{ $product->content }}</p>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $item->image }}">
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('site.shop_details', $item->slug) }}">{{ $item->name }}</a></h6>
                                <h5>${{ $item->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@stop
