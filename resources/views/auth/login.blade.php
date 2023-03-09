@extends('layouts.auth')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="col-12 col-md-7 "style="margin: auto !important ;">
            <div class="card detail">
                <div class="card-header navo ">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="row">
                        @csrf

                        <div class="row mb-3 col-12">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 col-12">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3 col-12">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 col-12">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn navo">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link log" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class='form-group row mt-4  col-12'>
                            <div class='offset-md-12 row  '>
                                <div class="col-12 my-2 col-md-6 ">
                                    <a href="{{route('login.facebook')}}" class="btn social">{{ __('Login With Facebook') }}</a>
                                
                                </div>
                                <div class="col-12 my-2 col-md-6">
                                    <a href="{{route('login.google')}}" class="btn social">{{ __('Login With Google') }}</a>
                            
                                </div>
                           </div>
                        </div>
                    </form>
                </div>
            
        </div>
        </div>
       
       
    </div>
</div>
@endsection
