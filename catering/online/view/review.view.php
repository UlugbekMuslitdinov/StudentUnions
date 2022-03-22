<div class="col-sm-12 <?= $restaurant ?>">
	<img src="img/highland_banner.jpg">
	<h1 class="page-header"><?php echo $pageSetting['header']; ?></h1>
	
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="panel">
			<!-- Default panel contents -->
			<div class="panel-heading">Customer Information</div>

			<div class="panel-body">

			<!-- List group -->
			<ul class="list-group">
				<li class="list-group-item"><b>Order Number : </b><?= $customer_info['id'] ?></li>
				<li class="list-group-item"><b>Delivery Method : </b><?= $customer_info['method'] ?></li>
				<li class="list-group-item"><b>Delivery Date : </b><?= date("m/d/Y", strtotime($customer_info['delivery_date'])) ?></li>
				<li class="list-group-item"><b>Delivery Time : </b><?= $customer_info['delivery_time'] ?></li>
				<?php if ( $customer_info['method'] == "Delivery" ){ ?>
				<li class="list-group-item"><b>Delivery Building : </b><?= $customer_info['delivery_building'] ?></li>
				<li class="list-group-item"><b>Delivery Room : </b><?= $customer_info['delivery_room'] ?></li>
				<li class="list-group-item"><b>On-site Contact : </b><?= $customer_info['onsite_name'] ?></li>
				<li class="list-group-item"><b>On-site Email : </b><?= $customer_info['onsite_email'] ?></li>
				<li class="list-group-item"><b>On-site Phone : </b><?= $customer_info['onsite_phone'] ?></li>
				<?php } ?>
				<li class="list-group-item"><b>Customer Name : </b><?= $customer_info['customer_name'] ?></li>
				<li class="list-group-item"><b>Customer Phone : </b><?= $customer_info['customer_phone'] ?></li>
				<li class="list-group-item"><b>Customer Email : </b><?= $customer_info['customer_email'] ?></li>
				<li class="list-group-item"><b>Payment Method : </b><?= $customer_info['payment_method'] ?></li>
                <li class="list-group-item"><b>Notes : </b><?= $customer_info['delivery_notes'] ?></li>
                <?php
				
				if($customer_info['payment_method'] == 'IDB'){
						echo "<li class='list-group-item'><b>Account Number : </b>" . $customer_info['account_num'] . "</li>";
						if($customer_info['sub_code'])
							echo "<li class='list-group-item'><b>Sub Code : </b>" . $customer_info['sub_code'] . "</li>";
					}
				
				
				?>
			</ul>
			</div>
		</div>

		<div class="panel order_detail">
			<!-- Default panel contents -->
			<div class="panel-heading">Order Detail</div>

			<div class="panel-body">

				<!-- print burrito -->
				<?php

				$total = 0;

				$pack = 0;
				$pack_num = 0;
				$burrito_num = 0;
				$print = '';
				foreach ($burritos as $burrito) {

					// New pack start
					if ($pack == $burrito_num){
						$extra_meat_subTotal = 0;
						$print .= '<div class="panel panel-default">';
						$pack = $burrito['pack'];
						$pack_num = $burrito["pack_num"];
						$burrito_num = 0;
						$print .= '<div class="panel-heading">'.$burrito['pack'].'-Pack #'.$burrito['pack_num'].'</div>';
						$print .= '<ul class="list-group">';
					}

					// Wrap burrito
					$print .= '<li class="list-group-item">';
					$print .= '<b> <img class="burr_icon" src="img/burr_icon.png"> #'.$burrito['burrito_num'].'</b> - ';

					$print_burr = "";
					$meat = 'meat_';
					$extra_meat_count = -1;
					for ($i=1; $i < 5; $i++) { 
						if ($burrito[$meat.$i] != ""){
							$print_burr .= $burrito[$meat.$i].', ';
							$extra_meat_count++;
						}
						// $print .= $burrito[$meat.$i].' ';
					}

					$vegi = 'vege_';
					for ($i=1; $i < 5; $i++) { 
						if ($burrito[$vegi.$i] != ""){
							$print_burr .= $burrito[$vegi.$i].', ';
						}
						// $print .= $burrito[$vegi.$i].' ';
					}

					$print_burr = rtrim($print_burr,', ');
					$print .= $print_burr;

					if ($extra_meat_count > 0){
						$print .= '<span class="meat_extra display_subprice">+ $'.($extra_meat_count*2).'.00</span>';
						$extra_meat_subTotal += $extra_meat_count;
					}


					$print .= '</li>';

					$burrito_num++;

					// End panel
					if ($burrito_num == $pack){
						// Print sub total for each pack
						$print .= '<li class="list-group-item">';
						$print .= '<div class="display_subtotal">Pack Subtotal : $';
						if ($pack == 12){
							$tempTotal = 120+($extra_meat_subTotal*2);
							// $print .= $tempTotal;
							$print .= '120.00';
						}else {
							$tempTotal = 89+($extra_meat_subTotal*2);
							// $print .= $tempTotal;
							$print .= '89.00';
						}
						$total += $tempTotal;

						if ($extra_meat_subTotal != 0){
							$print .= ' <span class="burr_subtotal">+ $'.$extra_meat_subTotal*2;
							$print .= '.00</span>';
						}

						$print .= '</div>';
						$print .= '</li>';

						// Wrap pack
						$print .= '</ul></div>';
					}
				}

				echo $print;

				?>
				<?php $extra_total = 0; ?>
				<div class="panel panel-default">
					<div class="panel-heading">Extras & Upgrade</div>
					<ul class="list-group">
					<li class="list-group-item"><b>Extra Chips, Salsa, Sour Cream, and Guacamole :</b> <?= $extra['extra_chips']  ?> <span class="display_subprice">+ $<?=number_format($extra['extra_chips']*3, 2, '.', ' ');?></span></li>
					   <!-- <li class="list-group-item"><b>Extra Chips :</b> <?= $extra['extra_chips']  ?> <span class="display_subprice">+ $<?=number_format($extra['extra_chips']*3, 2, '.', ' ');?></span></li>
						<li class="list-group-item"><b>Extra Salsa :</b> <?= $extra['extra_salsa']  ?> <span class="display_subprice">+ $<?=number_format($extra['extra_salsa']*3, 2, '.', ' ');?></span></li>
						<li class="list-group-item"><b>Extra Sourcream :</b> <?= $extra['extra_sourcream']  ?><span class="display_subprice">+ $<?=number_format($extra['extra_sourcream']*3, 2, '.', ' ');?></span></li>
						<li class="list-group-item"><b>Extra Guacamole :</b> <?= $extra['extra_guacamole']  ?><span class="display_subprice">+ $<?=number_format($extra['extra_guacamole']*3, 2, '.', ' ');?></span></li>
					   -->  <?php 
							$extra_total = ($extra['extra_chips'] + $extra['extra_salsa'] + $extra['extra_sourcream'] + $extra['extra_guacamole'])*3;
						?>

						<li class="list-group-item"><b>Upgrade :</b> <?= $extra['upgrade']  ?>
							<?php 
							$upgrade_cost = 0;

							if($extra['upgrade'] == 12) {
								$upgrade_cost = 18.00;
							} elseif($extra['upgrade'] == 8) {
								$upgrade_cost = 12.00;
							}

							$extra_total = $extra_total + $upgrade_cost; ?>
							<span class="display_subprice">+ $<?=number_format($upgrade_cost, 2, '.', ' ');?></span>
						<?php
						// Need to print out coke, diet coke, sprite, coke zero, dr.pepper
						if ($extra['upgrade'] != 0){?>
							<ul class="list-group">
						<?php
						if ($extra['coke'] != 0){
							// $extra_total = $extra_total+$extra['coke']*5.99;
						?>
							<li class="list-group-item"><b>Coke :</b> <?= $extra['coke']  ?></li>
						<?php
						}
						?>
						<?php
						if ($extra['diet_coke'] != 0){
							// $extra_total = $extra_total+$extra['diet_coke']*5.99;
						?>
							<li class="list-group-item"><b>Diet Coke :</b> <?= $extra['diet_coke']  ?></li>
						<?php
						}
						?>
						<?php
						if ($extra['sprite'] != 0){
							// $extra_total = $extra_total+$extra['sprite']*5.99;
						?>
							<li class="list-group-item"><b>Sprite :</b> <?= $extra['sprite']  ?></li>
						<?php
						}?>
						<?php
						if ($extra['fanta'] != 0){
							// $extra_total = $extra_total+$extra['sprite']*5.99;
						?>
							<li class="list-group-item"><b>Fanta :</b> <?= $extra['fanta']  ?></li>
						<?php
						}?>
						<?php
						if ($extra['water'] != 0){
							// $extra_total = $extra_total+$extra['sprite']*5.99;
						?>
							<li class="list-group-item"><b>Dasani Water :</b> <?= $extra['water']  ?></li>
						<?php
						}?>
						</ul>
						<?php
						}
						// var_dump($extra);
						?>
						</li>					
						<?php 
						$extra_total = number_format($extra_total, 2, '.', ' ');
						?>
						<li class="list-group-item"><div class="display_subtotal">Extra Subtotal : $<?=$extra_total?></div></li>
					</ul>
				</div>

				<!-- Display Total -->
				<div style="text-align: right; font-size:18px; font-weight:700;">Pack Subtotal + Extra Subtotal : $<?=number_format(($total+$extra_total), 2, '.', ' ');?></div>
				<div style="text-align: right; font-size:18px; font-weight:500;">Tax (6.1%) : $<?=number_format(($total+$extra_total)*6.1/100, 2, '.', ' ');?></div>
				<div class="display_total">Total : $<?=number_format(($total+$extra_total)*106.1/100, 2, '.', ' ');?></div>

			</div> <!-- End of panel-body -->

		</div>

		<form  action="post/post.php" method="POST">
			<input type="hidden" name="status" value="Complete Order">
			<div class="form-group">
				<label for="comment" style="font-size: 17px; color: #ac051f;">Additional Notes (Please provide any dietary restrictions/allergies, etc)</label>
				<textarea class="form-control" rows="5" id="comment" name="additional_comment"></textarea>
			</div>

			<hr style="padding-top: 15px;" /> 

			<strong>I understand that I must call Highland Market at 626-9662 to request any changes to my order after it’s submitted. Any changes requested less than 6 hours prior to my pick-up or delivery time cannot be guaranteed.</strong><br /><br />
			<div class="">
				<button class="btn btn-lg catering submit-btn" style="margin-bottom:20px; width: 100%;">Finish Order</button>
				<a href="cancel_order.php" class="cancel-order-btn">Cancel My Order</a>
			</div>
			<br/><br/>
		</form>

	</div>

</div>