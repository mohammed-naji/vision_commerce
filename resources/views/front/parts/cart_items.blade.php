<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__table">
                <table>
                    <thead>
                        <tr>
                            <th class="shoping__product">Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="shoping__cart__item">

                                    {{-- {{ $cart->product }} --}}

                                    <img width="80" src="{{ $cart->product->image }}" alt="">
                                    <h5>{{ $cart->product->name }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $cart->price }}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <span class="dec qtybtn">-</span>
                                            <input class="quantity-input" data-product_id="{{ $cart->product_id }}" type="text" value="{{ $cart->quantity }}">
                                            <span class="inc qtybtn">+</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    @php
                                        $subtotal += $cart->quantity * $cart->price;
                                    @endphp
                                    ${{ $cart->quantity * $cart->price }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <form action="{{ route('site.delete_product', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                        <button onclick="return confirm('Are you sure?!')" style="background: transparent; border: 0"><span class="icon_close"></span></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__btns">
                <a href="{{ route('site.shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                <a href="#" class="primary-btn cart-btn cart-btn-right cart-update"><span class="icon_loading"></span>
                    Upadate Cart</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shoping__continue">
                <div class="shoping__discount">
                    <h5>Discount Codes</h5>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">APPLY COUPON</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shoping__checkout">
                <h5>Cart Total</h5>
                <ul>
                    <li>Subtotal <span>${{ $subtotal }}</span></li>
                    <li>Total <span>${{ $subtotal }}</span></li>
                </ul>
                <a href="{{ route('site.checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    </div>
</div>
