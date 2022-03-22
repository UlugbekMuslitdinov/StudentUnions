<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstagramCache extends Model
{

    protected $connection = 'su';
    protected $table = 'InstagramCache';
    public $timestamps = false;
    protected $fillable = ['id', 'ig_id', 'caption', 'permalink', 'timestamp', 'media_url', 'refresh_date'];

    public static function get_data(){
        $ig_id = InstagramCache::select('*')->where('id', 1)->get();

        return $ig_id[0];
    }

    public static function set_id($ig_id, $caption, $permalink, $timestamp, $media_url, $date){
        $date=date("Y-m-d", strtotime($date));

        InstagramCache::truncate();

        $data = array(
                    'id' => 1,
                    'ig_id' => addslashes($ig_id), 
                    'caption' => addslashes($caption), 
                    'permalink' => addslashes($permalink), 
                    'timestamp' => addslashes($timestamp), 
                    'media_url' => addslashes($media_url),
                    'refresh_date' => $date
                );

        InstagramCache::create($data);
    }


}
