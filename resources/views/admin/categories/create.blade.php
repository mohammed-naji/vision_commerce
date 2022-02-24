@extends('admin.master')

@section('title', 'Add New Category')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Add New category</h3>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-warning px-4">All Categories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Name English</label>
                            <input name="name_en" class="form-control" placeholder="Name English" />
                        </div>

                        <div class="mb-3">
                            <label>Name Arabic</label>
                            <input name="name_ar" class="form-control" placeholder="Name Arabic" />
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" placeholder="Name" />
                        </div>

                        <div class="mb-3">
                            <label>Parent</label>
                            <select class="form-control" name="parent_id">
                                <option value="">--Select--</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->{'name_'.app()->currentLocale()} }}</option>
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
