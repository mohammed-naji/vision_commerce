@extends('admin.master')

@section('title', 'Edit Testimonial')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Edit testimonial <span class="text-danger">{{ $testimonial->name }}</span></h3>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-warning px-4">All Testimonials</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label>Content</label>
                            <input name="content" class="form-control" placeholder="Content" value="{{ $testimonial->content }}" />
                        </div>

                        <div class="mb-3">
                            <label>User</label>
                            <input name="user" class="form-control" placeholder="User" value="{{ $testimonial->user }}" />
                        </div>

                        <div class="mb-3">
                            <label>Position</label>
                            <input name="position" class="form-control" placeholder="Position" value="{{ $testimonial->position }}" />
                        </div>


                        <button class="btn btn-info px-5">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop
