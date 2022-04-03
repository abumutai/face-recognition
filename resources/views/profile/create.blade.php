@extends('layouts.app')

@section('title')
    <title>Profile</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Profile Details </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">{{Auth::user()->name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
            <p class="card-description">Student Profile Details </p>
            <form class="forms-sample" action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputName1">Student Number</label>
                <input type="text" style="color: black" class="form-control" id="exampleInputName1" name="no" value="{{Auth::user()->id}}" readonly placeholder="Name">
              </div>
                <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{Auth::user()->name}}" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail3" name="email" value="{{Auth::user()->email}}" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Phone</label>
                <input type="text" class="form-control" id="exampleInputEmail3" name="phone" value="{{$profile->phone}}" placeholder="Phone">
              </div>
              <div class="form-group">
                <label for="exampleSelectGender">Gender</label>
                <select class="form-control" id="exampleSelectGender" name="gender">
                  <option value="Male" {{$profile->gender=='Male' ? 'selected':''}}>Male</option>
                  <option value="Female" {{$profile->gender=='Female' ? 'selected':''}}>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label>Image upload</label>
                <input type="file" name="img" class="form-control">
            
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Year</label>
                <select class="form-control" id="exampleSelectGender" class="text-white" name="year">
                    <option  class="text-white" value="1" {{$profile->year==1 ? 'selected':''}}>First Year</option>
                    <option value="2" {{$profile->year==2 ? 'selected':''}}>Second Year</option>
                    <option value="3" {{$profile->year==3 ? 'selected':''}}>Third Year</option>
                    <option value="4" {{$profile->year==4 ? 'selected':''}}>Fourth Year</option>
                    <option value="5" {{$profile->year==5 ? 'selected':''}}>Fifth Year</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputCity1">Course</label>
                <input type="text" class="form-control" id="exampleInputCity1" name="course" value="{{$profile->course}}" placeholder="Course">
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