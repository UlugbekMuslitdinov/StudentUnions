<style>
.page-header {
	margin-top:0;
}
.info-form {
	margin-top:0px;
	/* margin-right:5px; */
}
</style>




<div class="col-sm-12">
	<?php 
	// if ($_SESSION['catering']['restaurant'] == 'highland_burrito'){ 
	if ($_SESSION['catering']['restaurant'] != '' && $_SESSION['catering']['restaurant'] != 'highland_burrito'){
		echo '<img id="banner_img" src="/catering/online/img/'.$_SESSION['catering']['restaurant'].'_banner.jpg" style="width:100%;">';
	}
	else{
	?>
	<img id="banner_img" src="/catering/online/img/highland_banner.jpg" style="width:100%;">
	<?php
	}
	?>
	<div class="jumbotron info-form" style="padding-top: 10px;">
    <h1 class="page-header"><?php echo $pageSetting['header']; ?></h1>
		<h2>POLICIES AND PROCEDURES</h2>
		<div class="form-group col-sm-4">
            <?php
            if ($_SESSION['catering']['restaurant'] != 'ondeck' && $_SESSION['catering']['restaurant'] != 'slotcanyon'){
			  echo '<select class="form-control col-sm-4" id="select_restaurant">';

					$restaurant_list = [
						"Highland Market" => "highland",
//						"On Deck Deli" => "ondeck",
						"Catalyst Cafe" => "catalyst",
//						"Slot Canyon Cafe" => "slotcanyon",
						"Einstein Bros Bagel" => "einsteins",
						"IQ Fresh" => "iq_fresh"
					];

					$print = "";
					foreach ($restaurant_list as $key => $value) {
						if ($restaurant_list[$key] != ""){
							$print .= '<option value="'.$value.'"';
							if ($_SESSION['catering']['restaurant'] == $value)
							{
								$print .= ' selected';
							}
							$print .= '>'.$key.'</option>';
						}
					}
					echo $print;

			echo "</select>";}
			?>
		</div>
		<div class="col-sm-12 wrap_ul_policy">
			<ul id="ul_policy">
				<?php
				if ($_SESSION['catering']['restaurant'] != '' && $_SESSION['catering']['restaurant'] != 'highland_burrito'){
					if ($_SESSION['catering']['restaurant'] != 'ondeck' && $_SESSION['catering']['restaurant'] != 'highland'){
						require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/policy/'.$_SESSION['catering']['restaurant'].'.php');
					}
					else {
						require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/policy/'.$_SESSION['catering']['restaurant'].'.php');
					}
				}
				else{
					require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/policy/highland_burrito.php'); 
				} 
				?>
			</ul>
		</div>
    <?php
    if ($_SESSION['catering']['restaurant'] != 'ondeck' && $_SESSION['catering']['restaurant'] != 'slotcanyon'){
        if ($_SESSION['catering']['restaurant'] == ''){$rest = 'highland_burrito';} else{$rest = $_SESSION['catering']['restaurant'];}
        echo "        <form action=\"/catering/online/post/post.php\" method=\"POST\">
	<input type=\"hidden\" name=\"status\" value=\"Agreement\">
	<input type=\"hidden\" name=\"agreeement\" value=\"agreed\">
	<input type=\"hidden\" id=\"hidden_restaurant\" name=\"restaurant\" value=\"$rest\">
	<button class=\"btn btn-primary btn-lg\">Agree</button>
	<a href=\"/catering/express\" class=\"btn btn-primary btn-lg\">Disagree</a>
</form>";
    }
    ?>

</div>
</div>