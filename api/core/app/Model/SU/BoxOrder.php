<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoxOrder extends Model
{

    protected $connection = 'su';
    protected $table = 'box_order';
    public $timestamps = false;
}
