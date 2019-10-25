<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Locations;
use Validator;
use DB; 
use App\Libraries\JsonResponse;  

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Locations::get();
        return $responses;
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
        // $validator = Validator::make($request->all(), $this->rules());
        // if ($validator->fails())    
        //     return JsonResponse::badRequest($validator->errors()->first());
        
        try{
            Locations::create([
                'location_name' => $request->input('location_name'),
                'location_address' => $request->input('location_address'),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
                'image_path' => $request->input('image_path'),
                'description' => $request->input('description'),
            ]);
        }catch (Exception $e) {
            return JsonResponse::internalServerError($e->getMessage());
        }

        return JsonResponse::created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkData = Locations::findOrfail($id);
        return $checkData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $locations = Locations::findOrfail($id);
            $locations->location_name = $request->input('location_name');
            $locations->location_address = $request->input('location_address');
            $locations->longitude = $request->input('longitude');
            $locations->latitude = $request->input('latitude');
            $locations->image_path = $request->input('image_path');
            $locations->description = $request->input('description');

            $locations->save();
        
        } catch (Exception $e) {
            return JsonResponse::internalServerError($e->getMessage());
         }
            return JsonResponse::ok();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locations $locations, $id)
    {
        $locations = Locations::findOrfail($id);
        $locations->delete();
        // dd($services->delete());
        return JsonResponse::ok(); 
    }
}
