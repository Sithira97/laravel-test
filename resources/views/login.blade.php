@extends('layouts.master')

@section('content')
    <main role="main" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <h5 class="card-header text-white bg-dark">{{ __('Login') }}</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('loginHandle') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email"
                                    class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control"
                                    name="email" value="" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password"
                                    class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control"
                                    name="password" required autocomplete="current-password">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
