<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerificationPhoto;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class VerificationPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photo = VerificationPhoto::where('user_id',Auth::user()->id)->first();
        return view('photos.create',compact('photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img'=>'required|mimes:png,jpeg,jpg'
        ]);
        try {
            if($request->has('img'))
            {
                $file = $request->file('img');
                $image = time().'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(300,300)->save(public_path('/uploads/'.$image));
            }
            $verificationPhoto = VerificationPhoto::where('user_id',Auth::user()->id)->first();
            if(!$verificationPhoto)
            {
                VerificationPhoto::create([
                    'user_id'=>Auth::user()->id,
                    'image'=>$image
                ]);
            }
            else{
                $verificationPhoto->update([
                    'image'=>$image
                ]);
            }
            return redirect()->back()->with('success','Verification photo successfully');
        } catch (Exception $e) {
            Log::critical($e);
            return redirect()->back()->withErrors('An unexpected error occurred. Please try again.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerificationPhoto  $verificationPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationPhoto $verificationPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VerificationPhoto  $verificationPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationPhoto $verificationPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VerificationPhoto  $verificationPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerificationPhoto $verificationPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VerificationPhoto  $verificationPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationPhoto $verificationPhoto)
    {
        //
    }
}
