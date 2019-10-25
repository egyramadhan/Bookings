<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paymentprocessors;
use Validator;
use DB; 
use App\Libraries\JsonResponse; 

class PaymentprocessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Paymentprocessors::get();
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
            Paymentprocessors::create([
                'payment_name' => $request->input('payment_name'),
                'payment_description' => $request->input('payment_description'),
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
        $checkData = Paymentprocessors::findOrfail($id);
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
            $paymentprocessor = Paymentprocessors::findOrfail($id);
            $paymentprocessor->payment_name = $request->input('payment_name');
            $paymentprocessor->payment_description = $request->input('payment_description');
            $paymentprocessor->save();
        
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
    public function destroy(Paymentprocessors $paymentprocessors, $id)
    {
        $paymentprocessors->delete();
        
        return JsonResponse::ok(); 
    }
}
