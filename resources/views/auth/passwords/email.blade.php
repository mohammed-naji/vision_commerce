@extends('front.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class=" mb-3">

                    <label>{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="mb-0">
                    <button type="submit" class="site-btn w-100">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
