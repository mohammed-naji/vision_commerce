@extends('admin.master')

@section('title', 'All Products')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All Products</h3>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-dark px-4">Add New Category</a>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.products.index') }}" method="get">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" placeholder="Search.." name="search" class="form-control" value="{{ request()->search }}">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info btn-block">Search</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped table-hover my-4">
                        <tr class="bg-dark">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $product->id }}</th>
                                    <th><img width="80" src="{{ asset('uploads/images/'.$product->image) }}" alt=""></th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ $product->price }}</th>
                                    <th>{{ $product->quantity }}</th>
                                    <th>{{ $product->discount }}</th>
                                    <th>{{ $product->category_id }}</th>
                                    <th>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                        <form class="d-inline"
                                            action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Are you sure?!')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>

                                    </th>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="8" align="center">No Products Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
