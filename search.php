<?php
	require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Search the student unions';
  page_start($page_options);
?>
<div style="margin-left:30px;">
<h1 style="margin-bottom:30px; font-size:18px;">search the student unions</h1>
<form action="search.php" id="cse-search-box" style="margin-left:15px;">
   <div>
    <input type="hidden" name="cx" value="008979135469412661396:3pqmv-1myq4" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="SEARCH" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=en"></script>
<div id="cse-search-results" width="100%"></div>
<script type="text/javascript">
  var googleSearchIframeName = "cse-search-results";
  var googleSearchFormName = "cse-search-box";
  //var googleSearchFrameWidth = 600;
  var googleSearchDomain = "www.google.com";
  var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
</div>
<?php page_finish() ?>
