<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use App\Models\User;
use App\Models\VerificationPhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;

class ScanController extends Controller
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
        return view('scans.create');
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
            'capture'=>'required',
            'no' =>'required'
        ]);
        try {
            $name= time().'.png';
            $path = public_path().'/scanned/'.$name;
            $save = Image::make(file_get_contents($request->capture))->resize(300,300)->save($path);
    
            $student = User::find($request->no);
            if(!$student)
            {
                return redirect()->back()->withErrors('Student details not found. Please enter a correct student number and try again');
            }
            $photo = VerificationPhoto::where('user_id',$student->id)->first();
            if(!$photo)
            {
                return redirect()->back()->withErrors('Student has not uploaded verification photo.');
            }
            $ver_photo = public_path().'/uploads/'.$photo->image;

            $hasher = new ImageHash(new DifferenceHash());
            $hash = $hasher->hash($path);
            $hash2 = $hasher->hash($ver_photo);
            $distance = $hasher->distance($hash,$hash2);
            $scan = Scan::create([
                'user_id'=>$request->no
            ]);
            if($distance>15)
            {
                return redirect()->back()->withErrors('Verification failed. Please try again');
            }
            else{
                $scan->update([
                    'status'=>1
                ]);
                return redirect()->route('scans.show',$scan->id)->with('success','Verification successful.');
            }
        } catch (Exception $e) {
            Log::critical($e);
            return redirect()->back()->withErrors('An unexpected error occurred. Please try again');
        }
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scan  $scan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scan = Scan::findOrFail($id);
        $user = User::findOrFail($scan->user_id);
        return view('scans.show',compact('scan','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scan  $scan
     * @return \Illuminate\Http\Response
     */
    public function edit(Scan $scan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scan  $scan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scan $scan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scan  $scan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scan $scan)
    {
        //
    }
}
