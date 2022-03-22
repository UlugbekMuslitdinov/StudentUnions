<?php

namespace App\Model\Deliverance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Current extends Model
{

    protected $connection = 'deliverance';
    protected $table = 'current';

    public function getResourceID($displayID){
        $current = $this->select('resourceID')
                           ->where('displayBlockID','=',$displayID)
                           ->first();

        return $current->resourceID;
    }

}
