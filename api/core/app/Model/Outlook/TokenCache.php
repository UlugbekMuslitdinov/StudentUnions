<?php

namespace App\Model\Outlook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TokenCache extends Model
{

    protected $connection = 'ms_outlook';
    protected $table = 'token_cache';
    public $timestamps = false;

}
