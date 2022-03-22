<?php
class db_mysqli extends mysqli{
	public $query;
	function __construct($db = NULL, $host = NULL, $user = 'web', $pass = 'viv3nij'){	//defined by host file entries
		$active_server=0;
		$activeServers = array('localhost', 'mysql_host', 'mysql_host2');
		
		if($host == NULL)
			$host = $activeServers[$active_server];
			
		@parent::__construct($host, $user, $pass);	
		if($db){
			$this->select_db($db);
		}
	}
}
?>