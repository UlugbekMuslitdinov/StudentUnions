<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoxChoice extends Model
{

    protected $connection = 'su';
    protected $table = 'box_choice';
    public $timestamps = false;

}
