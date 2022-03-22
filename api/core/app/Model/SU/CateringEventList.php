<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CateringEventList extends Model
{

    protected $connection = 'su';
    protected $table = 'catering_events_list';
    public $timestamps = false;

    public function getList(){
        $list = $this->select('*')->get();
        return $list;
    }

}
