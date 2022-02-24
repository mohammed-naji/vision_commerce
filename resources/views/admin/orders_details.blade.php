@extends('admin.master')

@section('title', 'All Orders')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Order User : <span class="text-danger">{{ $order->user->name }}</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <h5>
                        Order Products
                    </h5>
                    <table class="table table-bordered table-striped table-hover my-4">
                        <tr class="bg-dark">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        @foreach ($order->carts as $cart)
                            <tr>
                                <th>{{ $cart->id }}</th>
                                <th>{{ $cart->product->name }}</th>
                                <th>{{ $cart->product->price }}</th>
                                <th><img src="{{ $cart->product->image }}" width="80" alt=""></th>
                                <th>{{ $cart->quantity }}</th>

                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
    </script>

@stop
