@extends('admin.master')

@section('title', 'All Orders')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All Orders</h3>

                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped table-hover my-4">
                        <tr class="bg-dark">
                            <th>ID</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Details</th>
                        </tr>
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <th>{{ $order->id }}</th>
                                    <th>{{ $order->user->name }}</th>
                                    <th>{{ $order->total }}$</th>
                                    <th>
                                        <a href="{{ route('admin.orders.details', $order->id) }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-info-circle"></i></a>
                                    </th>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4" align="center">No Orders Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
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
