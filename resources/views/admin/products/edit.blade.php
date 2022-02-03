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

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label>Name</label>
                            <input name="name" class="form-control" placeholder="Name" value="{{ $product->name }}" />
                        </div>

                        <div class="mb-3">
                            <label>Content</label>
                            <textarea id="mytextarea" name="content" class="form-control" placeholder="Content" rows="5">{{ $product->content }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" />
                            <img width="120" class="img-thumbnail mt-2" src="{{ asset('uploads/images/'.$product->image) }}" alt="">
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input name="price" type="number" step="any" class="form-control" placeholder="Price" value="{{ $product->price }}"  />
                        </div>

                        <div class="mb-3">
                            <label>Quantity</label>
                            <input name="quantity" type="number" class="form-control" placeholder="Quantity" value="{{ $product->quantity }}" />
                        </div>

                        <div class="mb-3">
                            <label>Discount</label>
                            <input type="number" name="discount" value="{{ $product->discount }}" class="form-control"  />
                        </div>

                        <div class="mb-3">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">--Select--</option>
                                @foreach ($categories as $item)
                                <option {{ $product->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-success px-5">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>

@stop
