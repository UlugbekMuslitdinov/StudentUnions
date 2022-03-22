<div class="col-sm-12 <?= $restaurant ?>">
<img src="/catering/online/img/highland_banner.jpg">
	<h1 class="page-header"><?php echo $pageSetting['header']; ?></h1>
	<div style="margin-top:-15px;" align="right"><strong>Standard items come with eggs, cheese, potato, tortilla chips and salsa.</strong></div>
	<div class="col-sm-12 wrap-info">
		<form class="order-form" id="order-form" action="/catering/online/post/post.php" method="POST">
			<input type="hidden" name="status" value="Menu">
			<input type="hidden" name="location" value="Highland Burrito">
			<!-- Delivery Information -->
			<div class="panel panel-primary delivery_info wrap-info-box">
				<div class="panel-heading">
					<h3 class="panel-title">Select Party Pack</h3>
				</div>
				<div class="panel-body">

					<div class="col-sm-5">
						<table class="table">
							<tr>
								<th>ITEM</th>
								<th>PRICE</th>
								<th>QUANTITY</th>
							</tr>
							<tr>
								<td class="col-sm-3">12-Pack</td>
								<td class="col-sm-3">$120.00</td>
								<td>
									<!-- <div class="col-sm-3" id="pack12_qtn_display">0</div> -->
									<input type="number" name="pack12_quantity" class="col-sm-4" id="pack12_quantity" min="0" value="0">
									<div class="col-sm-7 wrap-plusminus-btn">
										<div class="btn btn-qtn-plus">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>

					<div class="col-sm-1"></div>

					<div class="col-sm-5">
						<table class="table">
							<tr>
								<th>ITEM</th>
								<th>PRICE</th>
								<th>QUANTITY</th>
							</tr>
							<tr>
								<td class="col-sm-3">8-Pack</td>
								<td class="col-sm-3">$89.00</td>
								<td>
									<input type="number" name="pack8_quantity" class="col-sm-4" id="pack8_quantity" min="0" value="0">
									<div class="col-sm-7 wrap-plusminus-btn">
										<div class="btn btn-qtn-plus">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<p class="text-danger input-err" id="quantity_err"></p>
					</div>					
				</div>
			</div>

			<div class="col-sm-12"></div>

			<div class="panel panel-primary delivery_info wrap-info-box">
				<div class="panel-heading">
					<h3 class="panel-title">Burrito Flavor Selections</h3>
				</div>
				<div class="panel-body" id="wrap_menu_selection">
					<h4 class="flavor_selection_title">Select 1 meat and up to 4 vegetables per burrito. Extra meat available  for $2.00</h4>
					<div id="wrap_selection12" class="panel-group">
					</div>
					<div id="wrap_selection8" class="panel-group">
					</div>
				</div>
			</div>

			<div class="panel panel-primary delivery_info wrap-info-box">
				<div class="panel-heading">
					<h3 class="panel-title">Extras & Upgrades</h3>
				</div>
				<div class="panel-body" id="wrap_menu_extra">
					<div class="wrap_extra col-sm-4">
						<table class="table">
							<tr>
								<th>ITEMS</th>
								<th>PRICE</th>
								<th>QUANTITY</th>
							</tr>
						  	<tr>
							  	<td>Bag of Chips</td>								
							  	<td>$3.00</td>
							  	<td>
							  		<input type="number" class="col-md-4" name="extra_chips" id="extra_chips" min="0" value="0">
							  		<div class="col-sm-7 wrap-plusminus-btn">
										<div class="btn btn-extra-qtn-plus">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-extra-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div>
								</td>
						  	</tr>
						  	<tr>
							  	<td>2oz. Roasted Salsa</td>
						  	</tr>
						  	<tr>
							  	<td>Sour Cream</td>
						  	</tr>
						  	<tr>
							  	<td>2oz. Guacamole</td>
						  	</tr>
						</table>
					</div>
					<div class="col-sm-1"></div>
					<div class="wrap_extra col-sm-6">
						<table class="table">
							<!-- <tr>
								<th>ITEM</th>
								<th>PRICE</th>
								<th>QUANTITY</th>
							</tr> -->
							<tr>
								<th>Party Pack Upgrade</th>
							</tr>
						  	<tr>
						  		<td>8 x 10oz. Cold Sodas</td>
							  	<td>$12.00</td>
							  	<td>
							  		<!-- <input type="number" name="party_pack_upgrade" class="col-md-3" id="party_pack_upgrade" min="0" value="0"> -->
							  		<input type="radio" id="eight_sodas" name="party_upgrade" value="eight_sodas">
							  		<!-- <div class="col-sm-7">
										<div class="btn btn-extra-qtn-plus wrap-plusminus-btn">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-extra-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div> -->
								</td>
						  	</tr>
						  	<tr>
						  		<td>12 x 10oz. Cold Sodas</td>
							  	<td>$18.00</td>
							  	<td>
							  		<!-- <input type="number" name="party_pack_upgrade" class="col-md-3" id="party_pack_upgrade" min="0" value="0"> -->
							  		<input type="radio" id="twelve_sodas" name="party_upgrade" value="twelve_sodas">
							  		<!-- <div class="col-sm-7">
										<div class="btn btn-extra-qtn-plus wrap-plusminus-btn">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-extra-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div> -->
								</td>
						  	</tr>
						  	<tr>
						  		<td>None</td>
							  	<td></td>
							  	<td>
							  		<!-- <input type="number" name="party_pack_upgrade" class="col-md-3" id="party_pack_upgrade" min="0" value="0"> -->
							  		<input type="radio" id="no_sodas" name="party_upgrade" value="no_sodas">
							  		<!-- <div class="col-sm-7">
										<div class="btn btn-extra-qtn-plus wrap-plusminus-btn">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-extra-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div> -->
								</td>
						  	</tr>
						</table>

						<p class="text-danger input-err" id="partyPack_upgrade_err"></p>
						
						<!-- <div class="col-sm-1"></div> -->

						<div class="col-sm-12">
							<label class="col-sm-12 remove-padding">Select a flavor per soda</label>
							<table class="table">
							<?php 
								$partyPack_upgrade_flavor = ['coke' => 'Regular Coke', 'diet_coke' => 'Diet Coke', 'sprite' => 'Sprite', 'fanta' => 'Orange Fanta', 'water' => 'Dasani Water'];
								foreach ($partyPack_upgrade_flavor as $key => $value) {
									$print = '<tr><td class="col-sm-4">'.$value.'</td>';
									$print .= '<td><input class="col-sm-3" type="number" name="'.$key.'" id="upgrade_'.$key.'" min="0" value="0"><div class="col-sm-9 wrap-plusminus-btn">
										<div class="btn btn-extra-qtn-plus">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</div>
										<div class="btn btn-extra-qtn-minus">
											<span class="glyphicon glyphicon-minus"></span>
										</div>
									</div></td></tr>';
									echo $print;
								}
							?>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Total Price -->
			<div id="before_total_price"></div>
			<div class="panel panel-primary total-price col-sm-12">
				<div>
					Total : $
					<input type="text" name="total_price" id="total_price" value="0" disabled="">
				</div>
			</div>

			<div class="col-sm-12">
				<input type="button" class="btn btn-lg catering submit-btn" id="reviewOrder" value="NEXT">
				<a href="cancel_order.php" class="cancel-order-btn">Cancel My Order</a>
			</div>
		</form>
	</div>
</div>