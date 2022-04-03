
@extends('layouts.auth')

@section('title')
    <title>New Scan</title>
@endsection
<style>
    #photo{
        display: none;
    }
</style>
@section('content')
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">Capture Photo</h3>
    <video id="video" width="500" height="300"></video>
    <div class="text-center">
        <a href="#" id="capture" class="btn btn-primary btn-block enter-btn">Take Photo</a>
      </div>
</div>
<div class="card-body px-5 py-5">
    <h3 class="card-title text-left mb-3">New Scan</h3>
    <form action="{{route('scans.store')}}" method="POST">
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
            <label>Captured Photo</label>
            <canvas id="canvas" width="500" height="300"></canvas>
            <input type="text" id="photo" class="form-control p_input" name="capture" required>
          </div>
      <div class="form-group">
        <label>Student Number *</label>
        <input type="integer" class="form-control p_input" name="no" required>
      </div>
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Verify</button>
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