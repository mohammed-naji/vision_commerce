@extends('admin.master')

@section('title', 'All Roles')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All Roles</h3>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-dark px-4">Add New Role</a>
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
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        @if ($roles->count() > 0)
                            @foreach ($roles as $role)
                                <tr>
                                    <th>{{ $role->id }}</th>
                                    <th>{{ $role->name }}</th>
                                    <th>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <form class="d-inline"
                                            action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
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
                            <td colspan="4" align="center">No Roles Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $roles->links() }}
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
