<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Days;
use Validator;
use DB; 
use App\Libraries\JsonResponse; 

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Days::get();
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
            Days::create([
                'days' => $request->input('days'),
                'is_working_days' => $request->input('is_working_days'),
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
        $checkData = Days::findOrfail($id);
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
            $days = Days::findOrfail($id);
            $days->days = $request->input('days');
            $days->is_working_days = $request->input('is_working_days');
            $days->save();
        
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
    public function destroy(Days $days, $id)
    {
        $days = Days::findOrfail($id);
        $days->delete();
        // dd($services->delete());
        return JsonResponse::ok(); 
    }
}
