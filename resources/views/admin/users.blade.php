@extends('admin.master')

@section('title', 'All Users')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All Users</h3>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.users') }}" method="get">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Orders Count</th>
                        </tr>
                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>{{ $user->orders->count() }}</th>

                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4" align="center">No Users Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
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
