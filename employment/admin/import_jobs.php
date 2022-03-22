<?php 
	class career{
		public $jobs;
		function __construct($report_id)
		{
			$param = array('intReportID'=>$report_id);
			try
			{
				$client = new SoapClient("https://www.career.arizona.edu/apps/WS/CS_Webservices.asmx?WSDL", array('trace' => 1));
			}
			catch(Exception $e)
			{
			    echo $e->getMessage();
			    return FALSE;
		  	}
			$listing = $client->CS_Get_JobListings($param);
			$xmlparse = simplexml_load_string($listing->CS_Get_JobListingsResult->any);
			
			if($xmlparse->ReportData['Job_JobTitle'])
			{
				$job = $xmlparse->ReportData;
				// get_object_vars() - Returns an associative array of defined object accessible non-static properties 
				// for the specified object in scope. If a property has not been assigned a value, it will be returned 
				// with a NULL value. 
				$job = get_object_vars($job);
				$this->jobs[$job['Job_ID']] = $job;
			}
			else
			{
				foreach($xmlparse->ReportData as $job)
				{
					$job = get_object_vars($job);
					$this->jobs[$job['Job_ID']] = $job;
				}
			}
		}

		function save_jobs()
		{
			require_once('includes/mysqli.inc');
			$db = new db_mysqli('student_hiring');
			$query ='select unit_id, name from units';
			$result = $db->query($query);
			while($unit = $result->fetch_assoc())
				$units[$unit['name']] = $unit['unit_id']; 
			// use the Employer_Division as the key to the
			// associative array, which should give us the
			// correct unit id.
			foreach($this->jobs as $job)
			{
				$unit_id = $units[$job['Employer_Division']];
				// if it is null, default to zero.
				if(!$unit_id)
					$unit_id=0;
				
				// if we don't get a match, parse out the Job_Employer variable.
				if ($unit_id == 0) 
				{
					// the Job_Employer is in the following
					$pos = strrpos($job['Job_Employer'], "-");
					if ($pos !== false) 
					{
						// get everything after the dash.
						$rest = substr($job['Job_Employer'], $pos+1);
						
						// trim off the right parenthesis.
						$rest = rtrim($rest, ")");
						
						// trim leading or trailing spaces.
						$rest = trim($rest);
						
						// try again.
						$job['Employer_Division'] = $rest;
						
						// var_dump($job);
						
						$unit_id = $units[$job['Employer_Division']];
						
						// if it is null, default to zero.
						if(!$unit_id)
							$unit_id=0;
					} 
				}
				
				// insert the extracted values into the joblink table.
				$query = 'insert into joblink set'.
					'   joblink_id='.intval($job["Job_ID"]).
					',  title="'.$db->escape($job['Job_JobTitle'], 255).
					'", description="'.$db->escape($job['Job_Description']).
					'", employer="'.$db->escape($job['Job_Employer']).
					'", contact="'.$db->escape($job['Job_Contact'], 50).
					'", pay="'.$db->escape($job['Job_SalaryLevel'], 20).
					'", contact_info="'.$db->escape($job['Job_ContactInformation']).
					'", start_date="'.$db->escape($job['Job_PostingDate']).
					'", end_date="'.$db->escape(date("Y-m-d", strtotime($job['Job_EndDate']))).
					'", qualifications="'.$db->escape($job['Job_Qualifications']).
					'", employer_division="'.$db->escape($job['Employer_Division']).
					'", unit_id="'.$unit_id.
					'", app_id="'."1".
					'"  on duplicate key update '.
					'   title="'.$db->escape($job['Job_JobTitle'], 255).
					'", description="'.$db->escape($job['Job_Description']).
					'", employer="'.$db->escape($job['Job_Employer']).
					'", contact="'.$db->escape($job['Job_Contact'], 50).
					'", pay="'.$db->escape($job['Job_SalaryLevel'], 20).
					'", contact_info="'.$db->escape($job['Job_ContactInformation']).
					'", start_date="'.$db->escape($job['Job_PostingDate']).
					'", end_date="'.$db->escape(date("Y-m-d", strtotime($job['Job_EndDate']))).
					'", qualifications="'.$db->escape($job['Job_Qualifications']).
					'", employer_division="'.$db->escape($job['Employer_Division']).
					'", unit_id="'.$unit_id.
					'", app_id="'."1".
					'"';
				$db->query($query);
			}

			$query = "delete from joblink where end_date<'".date("Y-m-d")."'";
			$db->query($query);
		}

		function get_saved_jobs($app_id){
			$db = new db_mysqli('student_hiring');
			$query = 'select * from joblink where app_id=' . $app_id;
			$result = $db->query($query);
			while($job = $result->fetch_assoc()){
				$this->jobs[$job['joblink_id']] = array("Job_ID" => $job['joblink_id'], "Job_JobTitle" => $job['title'], "Job_Description" => $job['description'], "Job_Employer"=>$job['employer'], "Job_Contact"=>$job['contact'], "Job_SalaryLevel"=>$job['pay'], "Job_ContactInformation"=>$job['contact_info'], "Job_PostingDate" => $job['start_date'], "Job_EndDate"=>$job['end_date'], "Job_Qualifications"=>$job['qualifications'], "Employer_Division"=>$job['employer_division'], "unit_id" => $job['unit_id']);
			}
		}
	}
?>