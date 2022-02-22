@extends('admin.master')

@section('title', 'Edit Blog')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Edit blog <span class="text-danger">{{ $blog->name }}</span></h3>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-warning px-4">All Blogs</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label>Name</label>
                            <input name="name" class="form-control" placeholder="Name" value="{{ $blog->name }}" />
                        </div>

                        <div class="mb-3">
                            <label>Content</label>
                            <textarea id="my_content" name="content" class="form-control" placeholder="Content" rows="5">{{ $blog->content }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" />
                            <img width="120" class="img-thumbnail mt-2" src="{{ asset('uploads/'.$blog->image) }}" alt="">
                        </div>


                        <div class="mb-3">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option  value="">--Select--</option>
                                @foreach ($categories as $item)
                                <option
{{ $blog->category_id == $item->id ? 'selected' : '' }}
                                value="{{ $item->id }}">{{ $item->{'name_'.app()->currentLocale()} }}</option>
                                @endforeach

                            </select>
                        </div>

                        <button class="btn btn-info px-5">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $("#my_content").emojioneArea();
    });
  </script>
@stop
