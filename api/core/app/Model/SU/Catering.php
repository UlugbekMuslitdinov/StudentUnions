<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catering extends Model
{

    protected $connection = 'su';
    protected $table = 'catering';
    public $timestamps = false;

    public function getRestaurant($location_id){
        $restaurant = $this->select('*')
                         ->where('location_id', '=', $location_id)
                         ->first();

        return $restaurant;
    }

    public function submissionCompelte($id, $order) {
        $catering = $this->where('id',$id)->update(['order' => $order, 'status' => 'Submitted']);
    }

}
