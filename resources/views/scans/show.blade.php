
@extends('layouts.auth')

@section('title')
    <title>Verification Successful</title>
@endsection
<style>
    #photo{
        display: none;
    }
    input{
        color: black !important;
    }
</style>
@section('content')
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">Verification Successful</h3>
    <img src="{{$user->profile->photo != null ? asset('uploads/'.$user->profile->photo) : asset('uploads/'.$user->verificationPhoto->image)}}" id="video" width="500" height="300"></video>
</div>
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">New Scan</h3>
    <form action="{{route('scans.store')}}" method="POST">
       
      <div class="form-group">
        <label>Student Number</label>
        <input type="integer" class="form-control p_input" name="no" readonly value="{{$user->id}}" required>
      </div>
      <div class="form-group">
        <label>Student Name</label>
        <input type="integer" class="form-control p_input" name="no" readonly value="{{$user->name}}" required>
      </div>
      <div class="form-group">
        <label>Year</label>
        <input type="integer" class="form-control p_input" name="no" readonly value="{{$user->profile->year}}" required>
      </div>
      <div class="form-group">
        <label>Course *</label>
        <input type="integer" class="form-control p_input" name="no" readonly value="{{$user->profile->course}}" required>
      </div>
      <div class="text-center">
        <a href="{{route('scans.create')}}" class="btn btn-primary btn-block enter-btn">New Verification</a>
      </div>
    </form>
</div>
<script>
    (function()
    {
        var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        photo = document.getElementById('photo'),
        vendorUrl = window.URL || window.webkitURL;

        navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
        navigator.getMedia({
            video: true,
            audio: false,
        },
        function(stream){
            video.srcObject = stream;
            video.play();
        }, 
        function(error){

        }
        );
        document.getElementById('capture').addEventListener('click',function(){
            context.drawImage(video,0,0,500,300);
            photo.value = canvas.toDataURL('image/png');
        });
    })();
</script>
@endsection