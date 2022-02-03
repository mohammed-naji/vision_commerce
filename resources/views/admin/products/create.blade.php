@extends('admin.master')

@section('title', 'Add New Product')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Add New product</h3>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning px-4">All Products</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input name="name" class="form-control" placeholder="Name" />
                        </div>

                        <div class="mb-3">
                            <label>Content</label>
                            <textarea id="mytextarea" name="content" class="form-control" placeholder="Content" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label>Album</label>
                            <input name="album[]" multiple type="file" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input name="price" type="number" step="any" class="form-control" placeholder="Price" />
                        </div>

                        <div class="mb-3">
                            <label>Quantity</label>
                            <input name="quantity" type="number" class="form-control" placeholder="Quantity" />
                        </div>

                        <div class="mb-3">
                            <label>Discount</label>
                            <input type="number" name="discount" placeholder="Discount" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">--Select--</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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

{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>

@stop
