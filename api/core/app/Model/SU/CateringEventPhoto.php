<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CateringEventPhoto extends Model
{

    protected $connection = 'su';
    protected $table = 'catering_events_photos';
    public $timestamps = false;

    public function getImagesByEvent($event_id){
        $imgs = $this->select('*')
                         ->where('event_id', '=', $event_id)
                         ->get();

        return $imgs;
    }

}
