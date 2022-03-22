<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restaurants extends Model
{

    protected $connection = 'su';
    protected $table = 'restaurants';

    public function getRestaurant($location_id){
        $restaurant = $this->select('*')
                         ->where('location_id', '=', $location_id)
                         ->first();

        return $restaurant;
    }

}
