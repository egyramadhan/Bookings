<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookings;
use App\Services;
use App\Locations;
use App\Providers;
use App\Status;
use App\Providerhasdays;
use App\Invoices;
use App\Paymentprocessors;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Bookings::get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $checkData = Bookings::findOrfail($id);
        // dd($checkData);
        $bookingId = $checkData;
        // $data = $bookingId->with('invoices');

        // $data['bookings'] = Bookings::find($bookingId->id)->with(['Invoice'])->with('Status')->get();
        $data['bookings'] = Bookings::find($bookingId->id)->with('Invoice','Status','Providers', 'Services', 'Locations')->get();
        // $data['invoices'] = Invoices::where('booking_id', $bookingId->id)->with('Paymentprocessors')->get();
        // $data['bookings']['services'] = Services::where('id',$data['bookings']->service_id)->get();
        // $data['bookings']['locations'] = Locations::where('id',$data['bookings']->location_id)->get();
        // $data['bookings']['providers'] = Providers::where('id',$data['bookings']->provider_id)->get();
        // $data['bookings']['providers']['Providerhasdays'] = Providerhasdays::where('id',$data['bookings']->provider_id)->get();
        // $data['bookings']['status'] = Status::where('id',$data['bookings']->status_id)->get();
        // $data['bookings']['invoices']['payment_processors'] = Paymentprocessors::where('id', $data['bookings']['invoices']->payment_processor_id)->get();
        // $data['invoices']['payment_processors'] = Paymentprocessors::where('id', $data['invoices']->payment_processors_id)->get();

        
        // dd($data);
        
        return $data;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
