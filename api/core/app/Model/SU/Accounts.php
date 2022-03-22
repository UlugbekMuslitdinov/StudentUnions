<?php

namespace App\Model\SU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accounts extends Model
{

    protected $connection = 'su';
    protected $table = 'accounts';
    public $timestamps = true;

    public function get_id_with_email($email, $name, $department){
        $account = $this->select('*')
                         ->where('email', '=', $email)
                         ->first();

        if ($account === null)
        {
            // Create New Account
            $account = New Accounts;
            $account->email = $email;
            $account->name = $name;
            $account->department = $department;
            $account->save();
        }

        return $account->id;
    }

}
