<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Specialdayrules;
use Validator;
use DB; 
use App\Libraries\JsonResponse;  

class SpecialDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Specialdayrules::get();
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
            Specialdayrules::create([
                'days' => $request->input('days'),
                'special_days' => $request->input('special_days'),
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
        $checkData = Specialdayrules::findOrfail($id);
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
            $special = Specialdayrules::findOrfail($id);
            $special->days = $request->input('days');
            $special->special_days = $request->input('special_days');

            $special->save();
        
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
    public function destroy(Specialdayrules $specialdayrules, $id)
    {
        $specialdayrules = Specialdayrules::findOrfail($id);
        $specialdayrules->delete();
        // dd($services->delete());
        return JsonResponse::ok(); 
    }
}
