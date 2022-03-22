<?php

namespace App\Model\Deliverance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resource extends Model
{

    protected $connection = 'deliverance';
    protected $table = 'resource';

    public function getResource($resourceID){
        $resource = $this->select('*')
                         ->where('id', '=', $resourceID)
                         ->first();

        return $resource;
    }

}
