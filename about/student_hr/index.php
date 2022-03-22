<?php
  header("Location: http://union.arizona.edu");
  die();  
  require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
  $page_options['title'] = 'About the Unions';
  $page_options['styles'] = '#center-col{width:780px;}';
  about_start($page_options);
?>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1//themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>


<style>
.tooltip {
  text-align: left;
  color: black;
  display: none;
  position: absolute;
}
.tooltip .text {
  	background-color: #E6E6E6;
  	color:black;
  	font-size: 12px;
  	margin-top: -15px;
  	width: 250px;
  	padding: 20px;
  	border: 1px solid #A8A8A8;
  	-moz-border-radius: 10px !important;
	-webkit-border-radius: 10px !important;
	-khtml-border-radius: 10px !important;
	border-radius: 10px !important;
}
</style>

<script>
$(document).ready(function() {
  $('.special').hover(function(){
  	$(this).next('.tooltip').show();
  	$(this).next('.tooltip').position({at: 'bottom center', of: $(this), my: 'bottom center'});
  })
  $('.special').mouseleave(function(){
  	$('.tooltip').hide();
  })
});

</script>
	<h1>The Student Human Resources (HR) Department </h1>


<div style="width: 900px;" >
	<br />
<h2>Meet Your Student Human Resources Representatives</h2>
<div style="float: left; margin-left: 5px; width: 180px;" >

	<a class="special" style="padding: 10px;"><img src="/template/images/photos/courtney_talak.jpg"   style="margin-top: 5px; margin-bottom: 15px; padding: 10px;" /></a>

	<p style="margin-left: 20px; margin-top: -20px; margin-left: 25px;">
		<b>Courtney Talak</b><br />
    Hiring and Retention Coordinator<br />
    <a href="mailto:ctalak@email.arizona.edu">ctalak@email.arizona.edu</a><br />
    (520) 626 9205<br />
    Main Student Union; Office #333<br />
	</p>
</div>

<div style="float: left; margin-left: 30px; width: 180px; margin-top: 10px;" >

	<a class="special" style="padding: 10px;"><img src="/template/images/photos/alejandra_arroyo.jpg"  style="margin-top: 5px; margin-bottom: 15px;" /></a>

	<p style="margin-left: 20px; margin-top: -10px;">
 		<b>Alejandra Arroyo</b><br />
    Training and Evaluation Coordinator<br />
    <a href="mailto:amarroyo@email.arizona.edu">amarroyo@email.arizona.edu</a><br />
    (520) 626 9205<br />
    Main Student Union; Office #333<br />
 	</p>
</div>

</div>
<br style="clear: both;" />

<p>
  It is our goal to provide expertise, leadership, and consultation to Arizona Student Union employees and students. We value excellence in service and strive to provide the best possible assistance and information to promote professionalism and educational success.
</p>

<h2>Student Human Resources Committee</h2>
<p>Student Human Resources is a student run committee developed by the Arizona Student Unions in response to the growing population of student employees. The Student Human Resources Committee focuses on the total welfare of the student employees by reviewing and making recommendations on union policies, job descriptions, and student cases in an environment that fosters learning, leadership, and personal growth.</p>
<br />
<h2>Want to be a Student Human Resources Liaison?</h2>
<p>The committee is always looking for members to promote growth and excellence in the student workforce. Please contact Courtney Talak at (520) 626 9205 or via email at <a href="mailto:ctalak@email.arizona.edu">ctalak@email.arizona.edu</a> for more information and find out how you can earn money while making a difference.</p>

<br />

 <?php about_finish() ?>
