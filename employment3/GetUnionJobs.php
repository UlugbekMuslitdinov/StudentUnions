<?php

/*

//if UnionJobListings are older then 30 min, grab them from JobLink again.
if($GLOBALS['UnionJobListings_timestamp'] < (time() - (1800))) { //1800 seconds is 30 min.

	print $GLOBALS['UnionJobListings_timestamp'];
	print "<br><br><br>";

	$GLOBALS['UnionJobListings_timestamp'] = time();
*/
unset($_SESSION['UnionJobListings']);
if(!isset($_SESSION['UnionJobListings']))
	{
		$param = array('intReportID'=>945);
		ini_set('default_socket_timeout', 5);
		$client = new SoapClient("https://www.career.arizona.edu/apps/WS/CS_Webservices.asmx?WSDL", array('trace' => TRUE, 'soap_version' => SOAP_1_2, 'connection_timeout' => 5));
		try 
		{
			$listing = $client->CS_Get_JobListings($param);
			$xmlparse = simplexml_load_string($listing->CS_Get_JobListingsResult->any);
		}
		//catch exception
		catch(Exception $e)
	  	{
	  		echo 'Message: ' .$e->getMessage();
	  	}
		
		$UnionJobListings_count = 0;
		$title = '';
		if($xmlparse->ReportData['Job_JobTitle'] != $title)
		{
			$title = $xmlparse->ReportData['Job_JobTitle'];
			// var_dump($xmlparse->ReportData);
			// die();
			$job = $xmlparse->ReportData;
			//var_dump($job);
			$UnionJobListings[$job->Job_ID] = array(
				'title'=>(string)$job->Job_JobTitle, 
				'description'=>(string)$job->Job_Description, 
				'supervisor'=>(string)$job->Job_Contact, 
				'dept_unit'=>(string)$job->Job_Employer, 
				'positionType'=>(string)$job->Job_PositionType, 
				'qualifications'=>(string)$job->Job_Qualifications
			);
		}
		else
		{
			if ($xmlparse->ReportData != NULL)
			{	
				foreach($xmlparse->ReportData as $job)
				{	
					$UnionJobListings[(string)$job->Job_ID] = array(
						'title'=>(string)$job->Job_JobTitle, 
						'description'=>(string)$job->Job_Description, 
						'supervisor'=>(string)$job->Job_Contact, 
						'dept_unit'=>(string)$job->Job_Employer, 
						'positionType'=>(string)$job->Job_PositionType, 
						'qualifications'=>(string)$job->Job_Qualifications
					);
				}
			}
		}

		//Register them to the session
		$_SESSION['UnionJobListings'] = $UnionJobListings;
		$_SESSION['UnionJobListings_count'] = count($UnionJobListings);

	}

?>