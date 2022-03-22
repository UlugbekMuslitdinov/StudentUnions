<?php
require_once 'template/fw.inc';
session_destroy();
session_start();
fw_start('Home');
?>
<p><strong>Family Weekend</strong> is a yearly event that provides an opportunity for the family of incoming (or currently enrolled) students a chance to see the beautiful University of Arizona campus. With a variety of programs your entire family can enjoy, it is guaranteed to be a memorable weekend, and we truly believe there will be something for everyone.</p>

<p><strong>The dates have been set for Family Weekend 2010:</strong><br />
&bull; Family Weekend 2010: October 8-10</p>

<p>Mark your calendars and be sure to check back later this year for more information.</p>

<p><a href="http://uanews.org/node/28159">See highlights from FW 2009</a></p>
<?php 
fw_finish();
?>