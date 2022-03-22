<?php

namespace App\Model\Hours;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exceptions extends Model
{

    protected $connection = 'hours2';
    protected $table = 'exceptions';

    public function checkTodayException($location_id){
        $exception = $this->select('*')
                        ->where('date_of', '=', date("Y-m-d", time()))
                        ->where('location_id', '=', $location_id)
                        ->first();

        $return = [ 'exception' => false ];
        if ($exception != null){
            $return = [
                'exception' => true,
                'data' => [
                    'open' => $exception->open,
                    'close' => $exception->close
                ]
            ];
        }

        return $return;
    }

}
