<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// namespace Function\LaravelDB;

use Illuminate\Database\Capsule\Manager as Capsule;

class CateringDB extends Capsule {
	protected $connections = [
		"su" => [
			"host" => "mysql_host",
			"database" => "su",
			"username" => "web",
			"password" => "viv3nij"
		],
		"hours2" => [
			"host" => "mysql_host",
			"database" => "su",
			"username" => "web",
			"password" => "viv3nij"
		],
		"hours3" => [
			"host" => "mysql_host",
			"database" => "su",
			"username" => "web",
			"password" => "viv3nij"
		]
	];

	public function __construct($database = 'su')
	{
		
		// echo $database;

		$capsule = new Capsule;
 
		$capsule->addConnection([
		 
			"driver" => "mysql",

			"host" => $this->connections[$database]['host'],

			"database" => $database,

			"username" => $this->connections[$database]['username'],

			"password" => $this->connections[$database]['password']
		 
		]);
		 
		$capsule->setAsGlobal();
		
		$capsule->bootEloquent();

	}	

}