<?php
define('ACCESS', true);
include('include.php');
?>
<script type="text/javascript" src="include.js"></script>
<script language="javascript">
window.onload = function() {
  var outcomes = opener.document.post.outcomes.value.split(', ');
  var elements = document.form.elements["outcomes[]"];
  
  if (isArray(outcomes))
  {
    for (i in elements)
    {
      for (j in outcomes)
	  {
        if (elements[i].value == outcomes[j])
          elements[i].checked = true;
	  }
    }
  }
}
</script>
<h2 align="center">CSIL Learning Outcomes</h2>
<form name="form" method="post">
<ol>
<?php
for ($i = 0; $i < count($outcomes); $i++)
{
	echo '<li><input type="checkbox" name="outcomes[]" value="' . ($i+1) . '" /><strong>' . $outcomes[$i]['name'] . '</strong>
	<p>' . $outcomes[$i]['description'] . '</p></li>' . "\n";
}
?>
</ol>
<input type="submit" onclick="return SelectOutcomes();" value="Select Outcomes">
</form>