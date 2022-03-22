<?php
  require_once('template/rooms.inc');
  $page_options['title'] = 'Room Rates';
  $page_options['page'] = 'Room Rates';
  $page_options['styles'] = 'table.display td, table.display th{ padding:4px; font-size:10px;}';
  rooms_start($page_options);
?>
<h1>Room Rates</h1>
<p>Please call the Event Planning office to inquire about room rates and reservation.<br />520-621-1414</p>

<?php
rooms_finish()
?>
