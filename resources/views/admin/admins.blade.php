@extends('admin.master')

@section('title', 'All Admins')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">All Admins</h3>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped table-hover my-4">
                        <tr class="bg-dark">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                        @if ($admins->count() > 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <th>{{ $admin->id }}</th>
                                    <th><a class="user" href="{{ route('admin.admins_edit', $admin->id) }}" data-toggle="modal" data-target="#exampleModal">{{ $admin->name }}</a> </th>
                                    <th>{{ $admin->email }}</th>
                                    <th>{{ $admin->role->name }}</th>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="3" align="center">No Admins Found</td>
                        </tr>
                        @endif

                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
            @csrf
            @method('put')
            <div class="modal-body">
                <select name="role_id" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
      </div>
    </div>
  </div>

@stop


@section('scripts')

    <script>

        $('.user').click(function() {
            var url = $(this).attr('href');

            $('.modal form').attr('action', url);
        })

        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
    </script>

@stop
