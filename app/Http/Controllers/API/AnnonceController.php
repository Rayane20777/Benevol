<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;


class AnnonceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $user_id = Auth::user()->id;    

        $request->validate([
            'titre'=>'required',
            'description'=>'required',
            'date'=>'required',
            'localisation'=>'required',
            'competence'=>'required',
        ]);


        $annonce=Annonce::create([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'date'=>$request->date,
            'localisation'=>$request->localisation,
            'competence'=>$request->competence,
            'user_id' => $user_id,
        ]);

        return response()->json([
            'message'=> 'success',
            'annonce'=> $annonce,
        ]);
    }
}
