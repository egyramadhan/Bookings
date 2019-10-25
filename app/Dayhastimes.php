<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dayhastimes extends Model
{
    protected $fillable = [
        'day_id','times_id','enable_day_times'

    ];
}
