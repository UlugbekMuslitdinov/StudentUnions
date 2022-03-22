<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoxMenu extends Model
{

    protected $connection = 'su';
    protected $table = 'box_menu';
    public $timestamps = false;

    public static function get_data_from_day($day){
        $data = BoxMenu::select('*')
                         ->where('date', '=', $day)
                         ->get();

        return $data;
    }
}
