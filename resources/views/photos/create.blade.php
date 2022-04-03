@extends('layouts.app')

@section('title')
    <title>Verification Photo</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Verification Photo </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">{{Auth::user()->name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Verification Photo</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Profile</h4>
            @if (session('success'))
                <div class="alert alert-success">
                  {{session('success')}}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <div class="alert alert-danger">
                      {{$item}}
                    </div>
                @endforeach
            @endif
            <p class="card-description">Student Verification Photo</p>
            <div class="row">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{Auth::user()->verificationPhoto!= null ? 'Current Photo' : 'Not uploaded'}}</h4>
                    <img src="{{Auth::user()->verificationPhoto!= null ? asset('uploads/'.Auth::user()->verificationPhoto->image) : asset('uploads/empty.png') }}" alt="">
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Last Changed</h6>
                        <p class="text-muted mb-0">{{Auth::user()->verificationPhoto!= null ? Auth::user()->verificationPhoto->created_at : 'Not changed' }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <form class="forms-sample" action="{{route('photo.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
            
              <div class="form-group">
                <label for="exampleInputCity1">Upload A New Photo</label>
                <input type="file" class="form-control" id="exampleInputCity1" name="img" value="" placeholder="Course">
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button class="btn btn-dark">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection