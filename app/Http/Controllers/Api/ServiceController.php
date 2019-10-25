<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookings;
use App\Services;
use Validator;
use DB;
use App\Libraries\JsonResponse;     

class ServiceController extends Controller
{
    public function rules()
    {
        return[
            'service_name' => 'required',
            'service_price' => 'required',
            'booking_time_interval' => 'required',
            'location_id' => 'required|exists:locations,id',
            'description' => 'required',
        ];
    }

    public function index()
    {
        $responses = Services::get();
        return $responses;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails())    
            return JsonResponse::badRequest($validator->errors()->first());
        
        try{
            Services::create([
                'service_name' => $request->input('service_name'),
                'service_price' => $request->input('service_price'),
                'booking_time_interval' => $request->input('booking_time_interval'),
                'location_id' => $request->input('location_id'),
                'description' => $request->input('description'),
            ]);
        }catch (Exception $e) {
            return JsonResponse::internalServerError($e->getMessage());
        }

        return JsonResponse::created();
    }

    public function show(Services $services)
    {
        return $services;
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails())    
            return JsonResponse::badRequest($validator->errors()->first());

        try {
            $services = Services::findOrfail($id);
            $services->service_name = $request->input('service_name');
            $services->service_price = $request->input('service_price');
            $services->booking_time_interval = $request->input('booking_time_interval');
            $services->location_id = $request->input('location_id');
            $services->description = $request->input('description');
            $services->save();
        
    } catch (Exception $e) {
        return JsonResponse::internalServerError($e->getMessage());
    }
    return JsonResponse::ok();
    
    }

    public function destroy(Services $services, $id)
    {
        $services->delete();
        // dd($services->delete());
        return JsonResponse::ok();
    }
    
}
