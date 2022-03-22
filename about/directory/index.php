<?php
/*
 * Staff Directory
 * Created April, 2010
 * Last Modified: by Alex Babis on 3/23/12.
 *    Directory is now fetched with AJAX and
 *    displayed in a div.
 */

define('ACCESS', true);
include('include.php');

require($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
$page_options['title'] = 'Staff Directory';
$page_options['page'] = 'Staff Directory';
$page_options['styles'] = '
#center-col {float: left;width: 780px;}';
about_start($page_options);
?>
<h1>Arizona Student Unions Staff Directory</h1>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var needsUpdate = 1;
    function update()
    {
    	if(needsUpdate)
    		$.post("directoryresults.php", { text: $("#staff_field").val(), department_id: $("#department_id").val()},
    			function(data)
    			{
    				$("#staff_listing").html(data);
    			}
    		);
    	needsUpdate = 0;
    }
    $(document).ready(function()
    	{
    		update();
    	}
    );
</script>
<style type="text/css">    
	#center-col {float: left;width: 780px;}
	.empty {font-size:16px; color:red;}
	.person {margin-bottom: 15px; font: 1.1em/1.63em Verdana,"Lucida Grande",Lucida,sans-serif; line-height: 18px;}
	/* .name {font-size: 16px; color: #003366;} */
	.name {font-size: 20px; color: #ac051f; font-family: MiloSerifWeb,TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif;}
	.contact {font-size: 0.7em;}
	.contact a {color: #003366 !important;}
	.contact a:hover {color: #CC0033 !important;}
	.department {font-size:0.7em;}
	.title {color: #3d582b; font-style: italic; font-size:0.7em;}
</style>
<br/>
Search for <input id="staff_field" type="text" maxlength="50" size="50" name="text" onkeydown="needsUpdate = 1; setTimeout('update()', 150); return true;"/>
 in <select id="department_id" onchange="needsUpdate = 1; setTimeout('update()', 150); return true;">
	<option value="all">All</option>
<?php
	$query = $db->query('SELECT id, departmentName FROM departments ORDER BY departmentName ASC');
	while($row = mysqli_fetch_assoc($query))
		echo '<option value="'.$row['id'].'">'.$row['departmentName'].'</option>\n';
?>
</select>
<br/>
<br/>
<br/>
 
<div id="staff_listing">
</div>

<?php about_finish() ?>