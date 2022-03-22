<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountEvent extends Model
{

    protected $connection = 'su';
    protected $table = 'accounts_events';
    public $timestamps = false;

}
