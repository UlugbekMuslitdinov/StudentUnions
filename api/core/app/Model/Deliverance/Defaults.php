<?php

namespace App\Model\Deliverance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Defaults extends Model 
{
    protected $connection = 'deliverance';
    protected $table = 'defaults';

    public function getResourceID($displayID){
        // We don't do null check since it will be always there
        $default = $this->select('resourceID')
                           ->where('displayBlockID','=',$displayID)
                           ->first();

        return $default->resourceID;
    }
}
