

@extends('layouts.auth')

@section('title')
    <title>Login</title>
@endsection

@section('content')
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">Login</h3>
    <form action="{{route('login')}}" method="POST">
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
        <label>Student Email *</label>
        <input type="text" class="form-control p_input" name="email">
      </div>
      <div class="form-group">
        <label>Password *</label>
        <input type="password" class="form-control p_input" name="password">
      </div>
      {{-- <div class="form-group d-flex align-items-center justify-content-between">
        <a href="#" class="forgot-pass">Forgot password</a>
      </div> --}}
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
       
      </div>
     
      <p class="sign-up mb-3">Don't have an Account?<a href="{{route('register')}}"> Sign Up</a></p>
      <a href="{{route('scans.create')}}" class="btn btn-primary btn-block enter-btn">Verification</a>
    </form>
</div>
@endsection