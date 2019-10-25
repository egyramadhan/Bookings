<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentprocessors extends Model
{
    protected $table = 'payment_processors';
    protected $guarded = [];

    // public function Invoices()
    // {
    //     return $this->hasMany('App\Invoices','payment_processor_id');
    // }

    // public function paymentprocessor()
    // {
    //     return $this->hasMany('App\Invoices','payment_processor_id');
    // }
}
