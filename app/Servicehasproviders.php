<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicehasproviders extends Model
{
    protected $filable = [
        'service_id','provider_id'
    ];
}
