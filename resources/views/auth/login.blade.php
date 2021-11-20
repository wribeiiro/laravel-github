@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <h2 class="text">Welcome again!</h2>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-12">
            <div class="card border-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-mail: ') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password: ') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-purple">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="col-md-12 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-vue" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <a class="btn btn-link text-vue" href="{{ route('register') }}">
                                    {{ __('Dont have an account?') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('social/auth', ['socialName' => 'github']) }}" class="btn btn-purple">
                                   <i class="fab fa-github"></i> {{ __('Connect with Github') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
