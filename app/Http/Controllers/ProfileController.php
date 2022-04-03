<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
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
        $profile = Profile::where('user_id',Auth::user()->id)->first();
        return view('profile.create',compact('profile'));
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'course' => 'string|required'
        ]);
        try {
            if($request->has('img'))
            {
                $file = $request->file('img');
                $image = time().'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(500,300)->save(public_path('/uploads/'.$image));
            }
            $profile = Profile::where('user_id',Auth::user()->id)->first();
            if(!$profile)
            {
                Profile::create([
                    'user_id'=>Auth::user()->id,
                    'phone'=>$request->phone,
                    'photo'=>$image,
                    'course'=>$request->course,
                    'year'=>$request->year,
                    'gender'=>$request->gender
                ]);
            }
            else{
                $profile->update([
                    'phone'=>$request->phone,
                    'photo'=>$image,
                    'course'=>$request->course,
                    'year'=>$request->year,
                    'gender'=>$request->gender
                ]);
            }
            $user= User::find(Auth::user()->id);
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
            return redirect()->back()->with('success','Profile updated successfully');
        } catch (Exception $e) {
            Log::critical($e);
            return redirect()->back()->withErrors('An unexpected error occurred. Please try again.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
