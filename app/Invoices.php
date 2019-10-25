<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoices';
    protected $guarded = [];

    // public function Paymentprocessors()
    // {
    //     return $this->hasOne('App\Paymentprocessors');
    // }
    // public function Paymentprocessors() {
    //     return $this->hasOne('App\Paymentprocessors');
    // }

   
}
