{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.auth')

@section('title')
    <title>Register</title>
@endsection

@section('content')
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">Register</h3>
    <form action="{{route('register')}}" method="POST">
        @csrf    
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div class="form-group">
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                </div>
            @endforeach
        @endif
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control p_input" name="name">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control p_input" name="email">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control p_input" name="password">
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control p_input" name="password_confirmation">
      </div>
      <div class="form-group d-flex align-items-center justify-content-between">
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input"> Remember me </label>
        </div>
      
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Sign Up</button>
      </div>
  
      <p class="sign-up text-center">Already have an Account?<a href="{{route('login')}}"> Sign In</a></p>
 
    </form>
  </div>
@endsection