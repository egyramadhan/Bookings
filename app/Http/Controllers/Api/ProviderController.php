<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers;
use Validator;
use DB; 
use App\Libraries\JsonResponse;  

class ProviderController extends Controller
{
    public function rules()
    {
        // return[
        //     'provider_name' => 'required',
        //     'provider_email' => 'required',
        //     'provider_phone' => 'required',
        //     'provider_status' => 'required',
        //     'is_visible_booking' => 'required',
        //     'client_at_same_time' => 'required',
        //     'provider_image_path' => 'required',
        //     'description' => 'required',
        // ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Providers::get();
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
            Providers::create([
                'provider_name' => $request->input('provider_name'),
                'provider_email' => $request->input('provider_email'),
                'provider_phone' => $request->input('provider_phone'),
                'provider_status' => $request->input('provider_status'),
                'client_at_same_time' => $request->input('client_at_same_time'),
                'provider_image_path' => $request->input('provider_image_path'),
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
        $checkData = Providers::findOrfail($id);
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
        // $validator = Validator::make($request->all(), $this->rules());
        // if ($validator->fails())    
        //     return JsonResponse::badRequest($validator->errors()->first());

        try {
            $providers = Providers::findOrfail($id);
            $providers->provider_name = $request->input('provider_name');
            $providers->provider_email = $request->input('provider_email');
            $providers->provider_phone = $request->input('provider_phone');
            $providers->provider_status = $request->input('provider_status');
            $providers->is_visible_booking = $request->input('is_visible_booking');
            $providers->client_at_same_time = $request->input('client_at_same_time');
            $providers->provider_image_path = $request->input('provider_image_path');
            $providers->description = $request->input('description');

            $providers->save();
        
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
    public function destroy(Providers $providers, $id)
    {
        $providers->delete();
        // dd($services->delete());
        return JsonResponse::ok();  
    }
}
