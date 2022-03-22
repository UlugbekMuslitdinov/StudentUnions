<?php
session_start();
if(!isset($_SESSION['user'])){
	exit();
}
require_once('includes/mysqli.inc');
$db = new db_mysqli('student_hiring');
$id=intval($_GET['id']);
$query = 'select * from applications left join resumes using(application_id) where application_id='.$id;
$result = $db->query($query);
$app = $result->fetch_assoc();
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
  
  
  $pdf->Cell(0, 0 , $app['lastName'].", ".$app['firstName'], 0 , 1 , 'C');
  
  $pdf->ln(5);
  
  $pdf->SetFontSize(12);
  $pdf->Write(7, "Personal Information:");
  $pdf->ln(7);
  $pdf->SetFontSize(9);
  
  $pdf->Write(3, "     " .$app['firstName']." " .$app['lastName']);
  $pdf->ln(5);
  
  $pdf->Write(3, "     ". $app['email']);
  $pdf->ln(5);
  $pdf->Write(3, "     ". $app['phoneNumber']);
  $pdf->ln(5);
  $pdf->Write(3, "     ". $app['address']);
  $pdf->ln(5);
  $pdf->Write(3, "     ". $app['city'].", ". $app['state']." ". $app['zip']);
  $pdf->ln(7);
  
  
  
  $work = ($app['previouslyWorked']==1)?"Yes" : "No";
  $pdf->SetTextColor(160);
  $pdf->Write(3, "     Worked for the Unions Before: ");
	$pdf->SetTextColor(0);
  $pdf->Write(3,$work);

  $pdf->SetFontSize(12);

 $query="select * from work_history where application_id=".$id;
  $result = $db->query($query);
  
  if($app['resume_id'] || $result->num_rows){
  
  $pdf->ln(7);
  $pdf->SetFontSize(12);
  $pdf->Write(7, "Work History:");
  $pdf->ln(7);
  $pdf->SetFontSize(10);
  
  
while($wh = $result->fetch_assoc()){
  
  $pdf->SetFont("Arial", "", 10);
  $pdf->Write(5, "     ".$wh['company']);
  $pdf->SetFont("Arial", "", 9);
  $pdf->Write(5, " - ".$wh['supervisor_name']."   |   ".$wh['phone_number']."   |   ".$wh['fromm'].'/'.str_pad(($wh['fromy']+79)%100, 2, '0', STR_PAD_LEFT).' - '.$wh['tom'].'/'.str_pad(($wh['toy']+79)%100, 2, '0', STR_PAD_LEFT)."   |   ".$wh['pay_rate']);
  $pdf->ln(5);
  $pdf->Write(3, "          Duties:  ");
  $pdf->MultiCell(0, 3, $wh['job_duties']);
  $pdf->ln(1);
  $pdf->Write(3, "          Reason for Leaving:  ");
  $pdf->MultiCell(0, 3, $wh['reason_leave']);
  $pdf->ln(5);
  }
  
  if($app['resume_id'] > 0){
  $pdf->SetFont("Arial", "", 10);
  $pdf->Write(5, "     See Resume");
  
  }
}
  $pdf->ln(1);
  
  if($app['comments'] != ''){
    $pdf->SetFontSize(12);
    $pdf->Write(7, "Comments:");
    $pdf->ln(7);
    $pdf->SetFontSize(9);
    $pdf->Write(5, "     ".$app['comments']);
  }
  
  
 $pdf->SetXY(140, 15);
  $pdf->SetFontSize(12);
  //$pdf->ln(5);
  
  
  
  $query="select * from schedules join semesters using(semester_id) where semester_id=".$_SESSION['current_semester']." and application_id=".$id;
$result = $db->query($query);
//while($sched = mysql_fetch_assoc($result)){
$sched = $result->fetch_assoc();
$sch[]= $sched;
//}
  $pdf->Write(7, $sched["name"]." Availability:");
  $pdf->ln(5);
  $pdf->SetFontSize(9);
  
  $time = array( '12 am', '1 am', '2 am', '3 am', '4 am', '5 am', '6 am', '7 am', '8 am', '9 am', '10 am', '11 am', 'noon', '1 pm', '2 pm', '3 pm', '4 pm', '5 pm', '6 pm', '7 pm', '8 pm', '9 pm', '10 pm', '11 pm');
  $pdf->SetX(140);
  foreach($sch as $sche){
  	$pdf->SetX(140);
    $pdf->Cell(55, 5, $sche['semester'], 0, 0, 'C', 0);
	$pdf->SetX(140);
    $pdf->Cell(10, 5, " ", 0, 0, 'C', 0);
  }
  $pdf->SetX(140);
  $pdf->Cell(1, 5, " ", 0, 1, 'C', 0);
  foreach($sch as $sche){
    $pdf->SetX(140);
    //$pdf->Write(3, $semester);
    //$pdf->ln(3);  
    $mon[$sche['semester']]= str_pad(decbin($sche['mon']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['mon2']), 24, '0', STR_PAD_LEFT);
    $tue[$sche['semester']]= str_pad(decbin($sche['tue']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['tue2']), 24, '0', STR_PAD_LEFT);
    $wed[$sche['semester']]= str_pad(decbin($sche['wed']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['wed2']), 24, '0', STR_PAD_LEFT);
    $thu[$sche['semester']]= str_pad(decbin($sche['thu']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['thu2']), 24, '0', STR_PAD_LEFT);
    $fri[$sche['semester']]= str_pad(decbin($sche['fri']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['fri2']), 24, '0', STR_PAD_LEFT);
    $sat[$sche['semester']]= str_pad(decbin($sche['sat']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['sat2']), 24, '0', STR_PAD_LEFT);
    $sun[$sche['semester']]= str_pad(decbin($sche['sun']), 24, '0', STR_PAD_LEFT ).str_pad(decbin($sche['sun2']), 24, '0', STR_PAD_LEFT);
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
    
  
  
    for($i=10; $i < 48; $i++){
    
      foreach($sch as $sche){
        //if($i > 12 && $i < 46)
          //$pdf->SetFont('Arial', 'b', 11);
		  
		 $pdf->SetX(140);
        $pdf->Cell(20, 5, $time[(int)$i/2] , 1, 0, 'C', 0);
        $pdf->SetFont('Arial', '');
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $mon[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $tue[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $wed[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $thu[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $fri[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $sat[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L T R", 0, 'C', $sun[$sche['semester']][$i]);
        $pdf->Cell(10, 2.5, " ", 0, 0, 'C', 0);
      }
      
      $i++;
      
      $pdf->Cell(1, 2.5, " ", 0, 1, 'C', 0);
      
      foreach($sch as $sche){
       $pdf->SetX(140);
        $pdf->Cell(20, 2.5, "", 0, 0, 'C', 0);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $mon[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $tue[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $wed[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $thu[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $fri[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $sat[$sche['semester']][$i]);
        $pdf->Cell(5, 2.5,  '', "L B R", 0, 'C', $sun[$sche['semester']][$i]);
        $pdf->Cell(10, 2.5, " ", 0, 0, 'C', 0);     
        
    
      }
      
      $pdf->Cell(1, 2.5, " ", 0, 1, 'C', 0);
      
      
  
    }
    $pdf->ln(3);
    foreach($sch as $sche){
    	 $pdf->SetX(140);
      $pdf->Write(3, "     Hours/week: ".$sche['hours_week']);
  
      $pdf->ln(2);
    }
    
  
  
  $pdf->ln(3);
     
  
  
  
  $pdf->Output('application.pdf', 'D');