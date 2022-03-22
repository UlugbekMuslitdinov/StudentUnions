<?php
  require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Live Webcam';
  page_start($page_options);
?>
<script language="JavaScript"><!--
function webPopUp(url) {webWin=window.open(url,"win",'toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width=400,height=400'); self.name = "mainWin"; }
function webPopUpHuge(url) {webWin=window.open(url,"win",'toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width=800,height=700'); self.name = "mainWin"; }
function moviePopUp(url) {movieWin=window.open(url,"win",'toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width=352,height=310'); self.name = "mainWin"; }
// -->
</script>
<style type="text/css">
  a {
    color:#BB2244;
    text-decoration:none;
  }
  #content {
    color: #444444;
    font-size: 12px;
    line-height: 14px;
  }
</style>
<div id="content" style="margin-top:10px;">
<!--
<h1 style="color: #776655;font-size: 18px;font-weight: bold;line-height: 20px;margin:6px;">Live Webcam</h1>
<table border="0" cellspacing="0" cellpadding="1" bgcolor="#999999" style="margin-left:20px;margin-bottom:10px;">
	<tr>
		<td>
			<div align="center">
				<a href="javascript:webPopUp('/construction/webcam/webcamWindow.html')"><img src="/union.jpg" alt="live image" height="288" width="352" border="0"></a></div>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="white">
				<tr>
					<td>
						<div align="center">click to open a new window: <a href="javascript:webPopUpHuge('/construction/webcam/webcamWindowHuge.html')">large</a> | <a href="javascript:webPopUp('/construction/webcam/webcamWindow.html')">small</a></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
-->

<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#333333">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td bgcolor="#cccccc">
						<p><b>Other webcams on campus:</b></p>
						<p><a href="http://www.cs.arizona.edu/camera/" target="_blank">Computer Science</a><br>
							<a href="http://www.optics.arizona.edu/jcwyant/webcam.htm" target="_blank">East Mall</a><br>
							<a href="http://www.optics.arizona.edu/WestWing/WestWingPhotos.htm" target="_blank">Meinel construction<br>
							</a><a href="http://ag.arizona.edu/agnet/livecam/" target="_blank">Old Main</a></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
<?php page_finish() ?>
