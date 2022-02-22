@extends('admin.master')

@section('title', 'All testimonials')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All testimonials</h3>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-dark px-4">Add New Tetimonial</a>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                    @endif


                    <table class="table table-bordered table-striped table-hover my-4">
                        <tr class="bg-dark">
                            <th>ID</th>
                            <th>Content</th>
                            <th>User</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                        @if ($testimonials->count() > 0)
                            @foreach ($testimonials as $tetimonial)
                                <tr>
                                    <th>{{ $tetimonial->id }}</th>
                                    <th>{{ $tetimonial->content }}</th>
                                    <th>{{ $tetimonial->user }}</th>
                                    <th>{{ $tetimonial->position }}</th>
                                    <th>
                                        <a href="{{ route('admin.testimonials.edit', $tetimonial->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                        {{-- <a href="{{ route('admin.testimonials.destroy', $tetimonial->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}

                                        <form class="d-inline"
                                            action="{{ route('admin.testimonials.destroy', $tetimonial->id) }}" method="POST">
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
                            <td colspan="5" align="center">No testimonials Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $testimonials->links() }}
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
