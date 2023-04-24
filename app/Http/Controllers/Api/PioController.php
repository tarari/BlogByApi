<?php

namespace App\Http\Controllers\Api;

use App\Models\Pio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pios=Pio::all();
        if($pios)
        return response()->json([
            'success'=>true,
            'data'=>$pios
        ]);
        return response()->json([
            'success'=>false,
            'data'=>'Pios not found'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'message'=>'required']);
            $pio=$request->user()->pios()->create($request->only('message'));
        }catch(\Throwable $t){
            return response()->json([
                'success'=>true,
                'data'=>$pio
            ],200);
        }
        return response()->json([
            'success'=>false,
            'data'=>'Pio not created'
        ],401);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function show(Pio $pio)
    {
        if($pio){
            return response()->json([
                'success'=>true,
                'data'=>$pio
            ]);
        }
        return response()->json([
            'success'=>false,
            'data'=>'Pios not found'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function edit(Pio $pio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pio $pio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pio $pio)
    {
        //
    }
}
