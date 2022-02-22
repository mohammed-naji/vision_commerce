@extends('admin.master')

@section('title', 'Edit Product')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Edit product</h3>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning px-4">All Products</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label>Name</label>
                                <input name="name" class="form-control" placeholder="Name"
                                    value="{{ $product->name }}" />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label>Content</label>
                                <textarea id="mytextarea" name="content" class="form-control" placeholder="Content"
                                    rows="5">{{ $product->content }}</textarea>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label>Image</label>
                                <input name="image" type="file" class="form-control" />
                                <img width="120" class="img-thumbnail mt-2"
                                    src="{{ asset('uploads/images/' . $product->image) }}" alt="">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label>Price</label>
                                <input name="price" type="number" step="any" class="form-control" placeholder="Price"
                                    value="{{ $product->price }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label>Quantity</label>
                                <input name="quantity" type="number" class="form-control" placeholder="Quantity"
                                    value="{{ $product->quantity }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label>Discount</label>
                                <input type="number" name="discount" value="{{ $product->discount }}"
                                    class="form-control" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">--Select--</option>
                                    @foreach ($categories as $item)
                                        <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <hr>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h4 class="m-0">Features</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="text-right mb-2">
                                            <button class="add_row btn btn-sm btn-dark">Add Row</button>
                                        </div>
                                        <div class="row_data">

                                            {{-- @dump($product->features) --}}

                                            @foreach ($product->features as $feature)
                                            <div class="row mb-3">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" name="fname[]" class="form-control"
                                                                placeholder="name" value="{{ $feature->name }}" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input type="text" name="fvalue[]" class="form-control"
                                                                placeholder="value" required value="{{ $feature->value }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="ftype[]" class="form-control"
                                                                placeholder="type" required value="{{ $feature->type }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-danger w-100 remove_row"><i class="fas fa-times"></i></button>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-success px-5">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"
        integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

        $('.add_row').click(function(e) {
            e.preventDefault();

            const row = `<div class="row mb-3">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="fname[]" class="form-control" placeholder="name" required>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" name="fvalue[]" class="form-control" placeholder="value" required>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" name="ftype[]" class="form-control" placeholder="type" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger w-100 remove_row"><i class="fas fa-times"></i></button>
                        </div>
                    </div>`;

            $('.row_data').append(row);

        });


        $('body').on('click', '.remove_row', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

    </script>

@stop
