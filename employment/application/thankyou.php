<?php

session_start();
require('application_db.inc');
$_SESSION['comments'] = $_POST['comments'];

if(!isset($_SESSION['app_id'])){
		header("Location: ./start.php");
		exit;
	}


//////////////////////////////////////
//          email applicant         //
//////////////////////////////////////

include("phplib/mimemail/htmlMimeMail5.php");
$mail1 = new htmlMimeMail5();
 

//Set the From and Reply-To headers
$mail1->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
$mail1->setReturnPath('no-reply@email.arizona.edu');

//Set the subject
$mail1->setSubject('Thank you for applying for a student job at the Arizona Student Unions!');



$body = '<p><h2>Thank you for applying for a student job at the Arizona Student Unions!</h2></p>
<p>
Your application will be forwarded to our hiring managers according to your<br>
preferences, and they will contact you soon with more information and<br>
instructions.
</p><p>
If you are hired, you must bring acceptable documentation as defined <a href="http://union.arizona.edu/employment/accept-docs.pdf">here</a> in<br>
order to complete the hiring process.
</p><p>
If you have any questions about your application, or working at the Student<br>
Union, please send us an email at unionshr@email.arizona.edu, or give us a call<br>
at 520-626-9205. Thank you again!
</p><p>
Note:  You must also be a registered UA, Pima, or<br>
high school student in order to work as a student employee.</p>';
	
$mail1->setHTML($body);
	
$result=$mail1->send(array($_SESSION['email']));



//////////////////////////////////////
//          make PDF                //
//////////////////////////////////////

require('phplib/fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();




$pdf->SetFont('Arial');
$pdf->SetFontSize(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(200);


$pdf->Cell(0, 0 , $_SESSION['last_name'].", ".$_SESSION['first_name'], 0 , 1 , 'C');

$pdf->SetFontSize(12);
$pdf->ln(5);


//$pdf->SetXY(10, 10);



$pdf->Write(7, "Availability:");
$pdf->ln(7);
$pdf->SetFontSize(9);
foreach($_SESSION['semesters'] as $semester){
	$pdf->Write(3, "     Hours/week: ".$_SESSION['work_hours'.$semester]);

	$pdf->ln(5);
}
$mon='';
$time = 12;
$ampm = ' am';

foreach($_SESSION['semesters'] as $semester){
	$pdf->Cell(55, 5, $semester, 0, 0, 'C', 0);
	$pdf->Cell(10, 5, " ", 0, 0, 'C', 0);
}
$pdf->Cell(1, 5, " ", 0, 1, 'C', 0);
foreach($_SESSION['semesters'] as $semester){
	
	/*$pdf->Write(3, $semester);
	$pdf->ln(3);*/	
	$mon[$semester]= str_pad(decbin($_SESSION[$semester]['mon']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['mon1']), 24, '0', STR_PAD_LEFT);
	$tue[$semester]= str_pad(decbin($_SESSION[$semester]['tue']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['tue1']), 24, '0', STR_PAD_LEFT);
	$wed[$semester]= str_pad(decbin($_SESSION[$semester]['wed']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['wed1']), 24, '0', STR_PAD_LEFT);
	$thu[$semester]= str_pad(decbin($_SESSION[$semester]['thu']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['thu1']), 24, '0', STR_PAD_LEFT);
	$fri[$semester]= str_pad(decbin($_SESSION[$semester]['fri']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['fri1']), 24, '0', STR_PAD_LEFT);
	$sat[$semester]= str_pad(decbin($_SESSION[$semester]['sat']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['sat1']), 24, '0', STR_PAD_LEFT);
	$sun[$semester]= str_pad(decbin($_SESSION[$semester]['sun']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($_SESSION[$semester]['sun1']), 24, '0', STR_PAD_LEFT);
	$pdf->Cell(20, 5, "Time", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "M", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "T", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "W", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "R", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "F", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "S", 1, 0, 'C', 0);
	$pdf->Cell(5, 5, "S", 1, 0, 'C', 0);
	$pdf->Cell(10, 5, " ", 0, 0, 'C', 0);
	
}
	$pdf->Cell(1, 5, " ", 0, 1, 'C', 0);
	


	for($i=0; $i < 48; $i++){
	
		foreach($_SESSION['semesters'] as $semester){
		
			$pdf->Cell(20, 5, $time.$ampm, 1, 0, 'C', 0);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $mon[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $tue[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $wed[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $thu[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $fri[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $sat[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $sun[$semester][$i]);
			$pdf->Cell(10, 2.5, " ", 0, 0, 'C', 0);
		}
		
		$i++;
		
		$pdf->Cell(1, 2.5, " ", 0, 1, 'C', 0);
		
		foreach($_SESSION['semesters'] as $semester){
		
			$pdf->Cell(20, 2.5, "", 0, 0, 'C', 0);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $mon[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $tue[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $wed[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $thu[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $fri[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $sat[$semester][$i]);
			$pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $sun[$semester][$i]);
			$pdf->Cell(10, 2.5, " ", 0, 0, 'C', 0); 		
			
	
		}
		
		$pdf->Cell(1, 2.5, " ", 0, 1, 'C', 0);
		
		$time = (($time+1)%12);
			
			if($time==12){
				$ampm = ' pm';
			}

	}
	
	


$pdf->ln(3);
$pdf->SetFontSize(12);
$pdf->Write(7, "Interested In:");
$pdf->ln(7);
$pdf->SetFontSize(9);
if($_SESSION['redistribute']=='any'){
$pdf->Write(5,"     Willing to work anywhere.");
}
elseif($_SESSION['redistribute']=='area'){
	$pdf->Write(5,"     The Following Area(s): ");
	if($_SESSION['Dining']!=''){
		$pdf->Write(5, $_SESSION['Dining'].", ");
	}
	if($_SESSION['Retail']!=''){
		$pdf->Write(5, $_SESSION['Retail'].", ");
	} 
	if($_SESSION['Operations']!=''){
		$pdf->Write(5, $_SESSION['Operations'].", ");
	} 
	if($_SESSION['CSIL']!=''){
		$pdf->Write(5, $_SESSION['CSIL']);
	} 
	
	
}
else{
$pdf->Write(3, "     ".implode(', ', $_SESSION['specificpos']));

}



$pdf->ln(5);



$pdf->SetFontSize(12);
$pdf->Write(7, "Personal Information:");
$pdf->ln(7);
$pdf->SetFontSize(9);

$pdf->Write(5, "     First Name: " .$_SESSION['first_name']."    Last Name: " .$_SESSION['last_name']);
$pdf->ln(5);
/*
$pdf->Write(3, "Email:". $_SESSION['email']);
$pdf->ln(3);
$pdf->Write(3, "Phone number:". $_SESSION['phone']);
$pdf->ln(3);
$pdf->Write(3, "Present address: ". $_SESSION['add']);
$pdf->ln(7);
*/
if($_SESSION['student'] == 'UA_student'){
	$pdf->Write(3,  "     U of A Student      Class: ".$_SESSION['year']);
}
else{
	$pdf->Write(3,  "     ".$_SESSION['student']."      Class: ".$_SESSION['year']);
}

$pdf->ln(5);
if($_SESSION['workStudy']==1){
	$pdf->Write(3, "     Work-study: Yes");
}
else{
	$pdf->Write(3, "     Work-study: No");
}
$pdf->ln(5);
if($_SESSION['workUnions']==1){
	$pdf->Write(3, "     Worked for the Student Unions Before: Yes");
}
else{
	$pdf->Write(3, "     Worked for the Student Unions Before: No");
}
$pdf->ln(5);

if($_SESSION['convitCrime']==1){

	$pdf->Write(3, "     Convicted of a crime: Yes");
	$pdf->ln();
	$pdf->Write(3, "     Explanation: ".$_SESSION['crime1']);
}
else{
	$pdf->Write(3, "     Convicted of a crime: No");
}
$pdf->ln(5);

$pdf->SetFontSize(12);
$pdf->Write(7, "Work History:");
$pdf->ln(7);
$pdf->SetFontSize(10);


for($a=1; $a < sizeof($_SESSION['com_name']); $a++){
$pdf->SetFont("Arial", "", 10);
$pdf->Write(5, "     ".$_SESSION['com_name'][$a]);
$pdf->SetFont("Arial", "", 9);
$pdf->Write(5, " - ".$_SESSION['supervisor_name'][$a]." | ".$_SESSION['com_phone'][$a]." | ".$_SESSION['fromm'][$a]."/".$_SESSION['fromy1'][$a]." - ".$_SESSION['tom'][$a]."/".$_SESSION['toy1'][$a]." | ".$_SESSION['textarea3'][$a]);
$pdf->ln(5);
$pdf->Write(3, "          Duties:");
$pdf->ln(3);
$pdf->Write(5, "               ".$_SESSION['textarea1'][$a]);
$pdf->ln(5);
$pdf->Write(3, "          Reason for Leaving:");
$pdf->ln(3);
$pdf->Write(5, "               ".$_SESSION['textarea4'][$a]);
$pdf->ln(5);
}

$pdf->ln(5);

if($_SESSION['comments'] != ''){
	$pdf->SetFontSize(12);
	$pdf->Write(7, "Comments:");
	$pdf->ln(7);
	$pdf->SetFontSize(9);
	$pdf->Write(5, "     ".$_SESSION['comments']);
}

$pdf_string = $pdf->Output('./PDF/newpdf.pdf', 'S');



//////////////////////////////////////
//          open pdf                //
//////////////////////////////////////

		
    $PDF_size = strlen($pdf_string);   
		$PDF_content = mysql_real_escape_string($pdf_string);




//////////////////////////////////////
//          save to database        //
//////////////////////////////////////


		  $query = 'update application set comments="'.substr($_POST['comments'],0,500).'", hired=0, date_submitted="'.date("Y-m-d").'" where studentID="'.$_SESSION['app_id'].'"';
		  db_query($query);
		  //print mysql_error($DBlink);
		  
		  $query = 'update student set active=1 where ID="'.$_SESSION['app_id'].'"';
		  db_query($query);
		  //print mysql_error($DBlink);
		  
	
		$query = "update application SET".
					" PDF           ='"         .$PDF_content.
					"', PDF_size            ="         .$PDF_size.
					" where studentID = ".$_SESSION['app_id'].
					";";
		db_query($query);
		// print mysql_error($DBlink);
		//print $query;
		//var_dump($_SESSION);
		
		
		session_destroy();
	
	
		require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['nav']['Employment']['Apply Now!']['link'] = '/employment/application/start.php';
  $page_options['nav']['Employment']['Available Positions']['link'] = '/employment/available.php';
  $page_options['nav']['Employment']['Student HR Department']['link'] = '/about/student_hr';
  $page_options['nav']['Employment']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $page_options['nav']['Employment']['FAQs']['link'] = '/employment/faq.php';
  $page_options['header_image'] = 'images/student_employment.png';
  page_start($page_options);
?>

<style type="text/css">
p{
						font-size:13px;
						margin-top: 15px;
						_margin-top: 14px;
						margin-bottom: 0px;
						line-height:15px;
					}

</style>
<div style="margin-left:30px;">
    
    <div style="margin-top:20px;">
    <img src="images/thankyou.gif" />
    </div>
    <div style="width:900px;">
    	<div style="float:left; width:400px;">
        	<div style="background-image:url(images/comments_BOX.gif); background-repeat:no-repeat; width:370px; _width:400px; height:234px; _height:254px; padding:15px;">
                
                <p>
                	Thank you for applying to the Arizona Student Unions!
                </p>
        
        		<p>
                	In order to check your application status and make changes to your information, simply log back into the application with your NetID and password. From the <a style="color:#387D31; font-size:13px;" href="./start.php">status page</a>, you may withdraw your application, upload files, view your status, and update your schedule and contact information.
                </p>
        
        		<p>
                	Please remember to bring acceptable documentation as defined <a href="../accept-docs.pdf">here</a> to all interviews; this is a requirement for hiring.
                </p>
            </div>
            
        </div>
   
     <div style="float:left; width:400px; margin-left:30px; position:relative; top:-40px;">
     	<img src="images/thankyou_page_cloud.gif" />
     </div>
    </div>
    </div>
    
     
</div>	
<?php page_finish(); ?>		
		