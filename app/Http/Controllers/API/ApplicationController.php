<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $user_id = Auth::user()->id;    

        $request->validate([
            'annonce_id'=> 'required',
        ]);


        $application=Application::create([
            'annonce_id'=>$request->annonce_id,
            'user_id' => $user_id,
        ]);

        return response()->json([
            'message'=> 'success',
            'annonce'=> $application,
        ]);
    }

    public function refuse(Request $request, $id)
    {
        $application = Application::findOrFail($id);

  
        $application->status = 'refused';
        $application->save();

        return response()->json([
            'message' => 'Application refused successfully',
            'application' => $application,
        ]);

        

        
    }

    public function confirm(Request $request, $id)
    {
        $application = Application::findOrFail($id);

  
        $application->status = 'confirmed';
        $application->save();

        return response()->json([
            'message' => 'Application refused successfully',
            'application' => $application,
        ]);


}
}