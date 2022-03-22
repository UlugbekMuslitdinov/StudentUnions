<?php

namespace App\Model\Hours;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Hours\Exceptions;

class Hours extends Model
{

    protected $connection = 'hours2';
    protected $table = 'hours';

    public function getTodayHour($location_id){
        // Check Exception first
        $exception = New Exceptions;
        $exc_today = $exception->checkTodayException($location_id);

        $return = ['open' => null, 'close' => null];
        if ($exc_today['exception']){
            $return = [
                        'open' => $exc_today['data']['open'], 
                        'close' => $exc_today['data']['close']
                    ];
        }
        else {
            $today = date("Y-m-d", time());
            $day = date("N");
            $dayName = ['', 'm', 't', 'w', 'r', 'f', 's', 'u'];
            
            $today_hour = $this->select('*')
                            ->join('periods', 'hours.type', '=', 'periods.type')
                            ->where('periods.start_date', '<=', $today)
                            ->where('periods.end_date', '>=', $today)
                            ->where('location_id', '=', $location_id)
                            ->first();

            if($today_hour != null){
                $return['hours_week'] = $today_hour;
                $return['open'] = $today_hour['open'.$dayName[$day]];
                $return['close'] = $today_hour['close'.$dayName[$day]];        
                $return['day'] = $day;
            }
        }

        return $return;
    }

}
