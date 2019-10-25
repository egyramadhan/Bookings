<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    
    
    protected $table = 'services';
    protected $guarded = [];

    // public function bookings()
    // {
    //     return $this->hasMany('App\Bookings');
    // }
}
