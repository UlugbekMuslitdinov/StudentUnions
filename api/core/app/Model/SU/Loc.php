<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Loc extends Model
{

    protected $connection = 'hours2';
    protected $table = 'location';

    protected $group_id = [
        'sumc' => 1,
        'psu' => 2,
        'other' => 3
    ];

    public function getLocation($location, $restaurant){
        if (!array_key_exists($location, $this->group_id)){
            return null; 
        }

        $restaurant = $this->select('*')
                         ->join('location_descriptions', 'location_descriptions.location_id', '=', 'location.location_id')
                         ->where('short_name', '=', $restaurant)
                         ->where('group_id', '=', $this->group_id[$location])
                         ->first();

        return $restaurant;
    }

    public function getRestaurants($location){
        if (!array_key_exists($location, $this->group_id)){
           return null; 
        }

        $restaurant = $this->select('location_name', 'location_url', 'short', 'short_name')
                         ->join('location_descriptions', 'location_descriptions.location_id', '=', 'location.location_id')
                        //  ->join('su.restaurants','su.restaurants.restaurant_id', '=', 'hours2.location.location_id')
                         ->where('group_id', '=', $this->group_id[$location])
                         ->where('subgroup', '=', 'Dining')
                         ->where('active', '!=', '0')
                         ->orderBy('location_name', 'ASC')
                         ->get();

        return $restaurant;
    }

}
