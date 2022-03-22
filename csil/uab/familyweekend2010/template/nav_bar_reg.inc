<div id="nav_bar">

<div class="nav_item"><a class="divlink" href="index.php">home</a></div>


<?php
switch($_SESSION['fw']['stage']){
	case 0:
	case 1:
		?>
		<div id="selected_nav_item">register</div>
		
		<div class="nav_incomplete_progress_item">friday's events</div>
		
		
		<div class="nav_incomplete_progress_item">saturday's events</div>
		
		<div class="nav_incomplete_progress_item">sunday's event</div>
		
		
		<div class="nav_incomplete_progress_item">confirm selections</div>
		
		
		<div class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 2:
		?>
		<div class="nav_complete_progress_item">register</div>
		<div id="selected_nav_item"class="nav_incomplete_progress_item">friday's events</div>
		
		
		<div class="nav_incomplete_progress_item">saturday's events</div>
		
		<div class="nav_incomplete_progress_item">sunday's event</div>
		
		
		<div class="nav_incomplete_progress_item">confirm selections</div>
		
		
		<div class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 3:
		?>
		<div class="nav_complete_progress_item">register</div>
		<div id="<?=$page=='Friday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">friday's events</div>
		
		
		<div id="<?=$page=='Saturday Events'?'selected_nav_item':''?>" class="nav_incomplete_progress_item">saturday's events</div>
		
		<div class="nav_incomplete_progress_item">sunday's event</div>
		
		
		<div class="nav_incomplete_progress_item">confirm selections</div>
		
		
		<div class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 4:
		?>
		<div class="nav_complete_progress_item">register</div>
		<div id="<?=$page=='Friday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">friday's events</div>
		
		
		<div id="<?=$page=='Saturday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">saturday's events</div>
		
		<div id="<?=$page=='Sunday Events'?'selected_nav_item':''?>" class="nav_incomplete_progress_item">sunday's event</div>
		
		
		<div class="nav_incomplete_progress_item">confirm selections</div>
		
		
		<div class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 5:
	case 6:
		?>
		<div class="nav_complete_progress_item">register</div>
		<div id="<?=$page=='Friday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">friday's events</div>
		
		
		<div id="<?=$page=='Saturday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">saturday's events</div>
		
		<div id="<?=$page=='Sunday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">sunday's event</div>
		
		
		<div id="<?=($page=='T-Shirts' || $page=='Confirm Selection')?'selected_nav_item':''?>" class="nav_incomplete_progress_item">confirm selections</div>
		
		
		<div class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 7:
		?>
		<div class="nav_complete_progress_item">register</div>
		<div id="<?=$page=='Friday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">friday's events</div>
		
		
		<div id="<?=$page=='Saturday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">saturday's events</div>
		
		<div id="<?=$page=='Sunday Events'?'selected_nav_item':''?>" class="nav_complete_progress_item">sunday's event</div>
		
		
		<div id="<?=($page=='T-Shirts' || $page=='Confirm Selection')?'selected_nav_item':''?>" class="nav_complete_progress_item">confirm selections</div>
		
		
		<div id="<?=$page=='Payment'?'selected_nav_item':''?>" class="nav_incomplete_progress_item">payment</div>
		
		<div class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
	case 8:
		?>
		<div  class="nav_complete_progress_item">register</div>
		<div  class="nav_complete_progress_item">friday's events</div>
		
		
		<div  class="nav_complete_progress_item">saturday's events</div>
		
		<div  class="nav_complete_progress_item">sunday's event</div>
		
		
		<div  class="nav_complete_progress_item">confirm selections</div>
		
		
		<div  class="nav_complete_progress_item">payment</div>
		
		<div id="selected_nav_item" class="nav_incomplete_progress_item">signup complete</div>
		<?php
	break;
}
?>
</div>