<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script type="text/javascript" src="remote_slideshow.js"></script>
		<script type="text/javascript">
			setInterval('updateClock()', 500);
			function updateClock()
			{
				var date = new Date();
				$("#time").html(date.toString());
			}
			$(document).click(function()
				{
					$('#debug').toggle();
				});
		</script>
		<style>
			* {
				cursor: none;
			}
			body {
				margin:0px;
				padding:0px;
				background-color:#000000;
				overflow:hidden;
				cursor:none;
			}
			#content {
				margin:0px;
				padding:0px;
				z-index:0;
			}
		</style>
	</head>
	<body onload="start('fetch.php?set=<?=$_GET['set'] ?>', '#content', '#slidesInfo');">
		<div id="content">
		</div>
		<div id="debug" style="position:absolute; right:0px; padding:5px; color:#FFF; background-color:black; display:none;">
			<table>
				<tr><td>Initial Load Time:</td><td><?=date("D M j Y G:i:s T", time())?></td></tr>
				<tr><td>Current JS Time:</td><td><span id="time"></span></td></tr>
			</table>
			<br/>
			<div id="slidesInfo"></div>
		</div>
	</body>
</html>
