<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RestaurantSlides extends Model
{

    protected $connection = 'su';
    protected $table = 'restaurants_slides';

    public function getSlides($restaurant_id){
        $slides = $this->select('*')
                         ->where('restaurant_id', '=', $restaurant_id)
                         ->get();

        return $slides;
    }

}
