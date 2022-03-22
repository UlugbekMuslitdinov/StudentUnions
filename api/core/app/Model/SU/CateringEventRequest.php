<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CateringEventRequest extends Model
{

    protected $connection = 'su';
    protected $table = 'catering_event_requests';
    public $timestamps = true;

}
