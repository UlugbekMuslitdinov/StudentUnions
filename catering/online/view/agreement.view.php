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
			<select class="form-control col-sm-4" id="select_restaurant">
				<?php 
					$restaurant_list = [
						"Highland Market" => "highland", 
						"On Deck Deli" => "ondeck", 
						"Catalyst Cafe" => "catalyst",
						"Slot Canyon Cafe" => "slotcanyon",
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
				?>
			</select>
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
		<form action="/catering/online/post/post.php" method="POST" id="choice">
			<input type="hidden" name="status" value="Agreement">
			<input type="hidden" name="agreeement" value="agreed">
<!--			<input type="hidden" id="hidden_restaurant" name="restaurant" value="--><?php // if ($_SESSION['catering']['restaurant'] == ''){echo 'highland_burrito';} else{echo $_SESSION['catering']['restaurant'];} ?><!--">-->
<!--            --><?php // if ($_SESSION['catering']['restaurant'] != 'ondeck') {
//                echo '<button class="btn btn-primary btn-lg">Agree</button>';
//			    echo '<a href="/catering/express" class="btn btn-primary btn-lg">Disagree</a>';}
//            ?>
<!--            --><?php
//            if ($_SESSION['catering']['restaurant'] != 'ondeck') {
//                require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/view/btns.php');
//            }
//            ?>
            <script>
                var select = document.getElementById("select_restaurant");

                var value = select.options[sel.selectedIndex].value;

                if (value == "ondeck" || value == "highland") {
                    document.getElementById("choice").style.display = 'none';
                }
                else{
                    document.getElementById("choice").style.display = 'flex';
                }
            </script>
		</form>
	</div>

</div>