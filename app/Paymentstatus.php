<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentstatus extends Model
{
    protected $filable  = [
        'payment_status_name','description','created_at','updated_at'
    ];
}
