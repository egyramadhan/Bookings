<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $table = 'bookings';
    protected $guarded = [];

    // public function bookings()
    // {
    //     return $this->belongsTo('App\Bookings');
    // }
    public function Invoice()
    {
        return $this->hasMany('App\Invoices', 'booking_id');
    }
    public function Status()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }
    public function Providers()
    {
        return $this->belongsTo('App\Providers', 'provider_id');
    }
    public function Services()
    {
        return $this->belongsTo('App\Services', 'service_id');
    }
    public function Locations()
    {
        return $this->belongsTo('App\Locations', 'location_id');
    }
    
}
