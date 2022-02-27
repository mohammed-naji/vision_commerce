@extends('admin.master')

@section('title', 'Add New Role')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Add New role</h3>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-warning px-4">All Roles</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.errors')

                    <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input name="name" class="form-control" placeholder="Name" />
                        </div>

                        <div class="mb-3">
                            <label>Abilities</label>

                            <br>

                            @foreach ($abilities as $ability)
                                <input type="checkbox" name="abilities[]" value="{{ $ability->id }}"> {{ $ability->name }} <br>
                            @endforeach
                        </div>


                        <button class="btn btn-success px-5">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop
