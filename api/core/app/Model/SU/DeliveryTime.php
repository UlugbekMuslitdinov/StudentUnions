<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTime extends Model
{

    protected $connection = 'su';
    protected $table = 'delivery_timings';
    public $timestamps = false;

    public static function get_timing_from_id($location_id){
        $delivery_timing = DeliveryTime::select('*')
                         ->where('location_id', '=', $location_id)
                         ->get();

        return $delivery_timing;
    }

    public static function get_timing_from_name($name){
        $delivery_timing = DeliveryTime::select('*')
                         ->where('name', '=', $name)
                         ->get();

        return $delivery_timing;
    }


}
