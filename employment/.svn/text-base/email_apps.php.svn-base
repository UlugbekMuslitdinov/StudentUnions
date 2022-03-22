<?php
include("mimemail/htmlMimeMail.php");
$DBlink = mysql_connect('trinity.sunion.arizona.edu', 'web', 'viv3nij');
mysql_select_db('unions_app');

$query ='select distinct email from student join checked_out on student.ID = checked_out.studentID where (phase<>4 and phase<>5) or phase is null';
$qresult = mysql_query($query);
print mysql_error();
//$app = mysql_fetch_assoc($qresult);
while($app = mysql_fetch_assoc($qresult)){
$mail1 = new htmlMimeMail();
 

//Set the From and Reply-To headers
$mail1->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
$mail1->setReturnPath('no-reply@email.arizona.edu');

//Set the subject
$mail1->setSubject('Thank you for applying for a student job at the Arizona Student Unions!');



$body = '<p>**Please disregard this message if you have already been hired at the Arizona Student Unions.
</p>
<p>
Dear Applicant,
</p>
<p>
Thank you for applying for a job with the Arizona Student Unions. At this time most of our positions have been filled for the Fall 2010 semester. If you are still interested in a position, our recommendation is to visit or call the location you would like to gain employment with and ask to speak to the manager or supervisor. There may be specific shifts available that the location still needs to fill.  Inform the supervisor that you applied online, and they will be able to look up your application in the system.  For a list of locations still currently seeking applicants, visit www.union.arizona.edu/jobs and click on "Available Positions."
</p>
<p>
Also, if you have not already done so, log back into your application and make edits to your schedule if it has changed, or change the positions you are applying for. You can do this by visiting www.union.arizona.edu/jobs �and clicking "Apply Now". This will take you to a page where you will need to log in using your NET ID or the email and password you originally used to create an application. Once at your status page, you may "Edit" and go back into your application. When you are finished, all you need to do is hit "Save and Continue" on the page(s) you changed. You do not need to re-submit your entire application.
</p>
<p>
Finally, make sure you check out the Career Services website www.career.arizona.edu and Wildcat Joblink. Here you can find postings for on and off campus jobs. There are still several places hiring for the fall semester.
</p>
<p>
If you have any questions please feel free to contact Student Human Resources at unionshr@email.arizona.edu or by calling (520) 626-9205.
</p>
<p>
Ashley Rae LaBar<br />
Student Human Resources Coordinator<br />
Arizona Student Unions
</p>
';
	
$mail1->setHTML($body);
	//$result=$mail1->send(array('kbeyer@email.arizona.edu'));
$result=$mail1->send(array($app['email']));
print $result.'<br>';
print $app['email'].'<br>';
}
?>