<?php
	require('global.inc');
  $page_options['title'] = 'Accolades';
  page_start($page_options);
?>

<script language="javascript">
function nav()
   {
   var w = document.myform.mylist.selectedIndex;
   var url_add = document.myform.mylist.options[w].value;
   window.location.href = url_add;
   }
</script>
</head>

<div style="width:600px;">

<a href="/csil/Accolades/"><img src="../AccoladesLogoFINAL.gif" /></a>

<!--<img src="Accoladeslogofinal.gif" />-->

<p>Welcome to the Accolades BACKWEB</p>

<a href="backweballindv.php">All Individual Award Nominations</a><br />
<a href="bwsearchindv.php">Search Individual Award Nominations</a><br />
<a href="backweballgrp.php">All Groups Award Nominations</a><br />

<?php page_finish() ?>