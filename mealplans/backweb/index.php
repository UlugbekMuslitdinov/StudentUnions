<?php
//include backweb template
require_once('template/mpbackweb.inc');
//start page
mpbackweb_start('home');
?>
<h2>New &amp; Pending Deposits</h2>
<ul class="horz-nav tabs">
<!--<li id="export-errors-tab" onclick="switch_tabs('export-errors')" class="active">Export Errors()</li>-->
	<li id="pending-deposits-tab" onclick="switch_tabs('pending-deposits')">Pending Deposits()</li>
	<li id="recently-completed-tab" onclick="switch_tabs('recently-completed')">Recently Completed</li>
	<li id="lost-cards-tab" onclick="switch_tabs('lost-cards')">Lost Cards</li>
</ul>
<!-- 
<div id="export-errors" class="view">
	<ul class="horz-nav time-choices">
		<li><input type="radio" name="when-ee" onclick="get_export_errors(<?=time()-(7 * 24 * 60 * 60)?>)" checked /> One Week</li>
		<li><input type="radio" name="when-ee" onclick="get_export_errors(<?=time()-(14 * 24 * 60 * 60)?>)" /> Two Week</li>
		<li><input type="radio" name="when-ee" onclick="get_export_errors(<?=time()-(30 * 24 * 60 * 60)?>)" /> One Month</li>
		<li><input type="radio" name="when-ee" onclick="get_export_errors(<?=time()-(90 * 24 * 60 * 60)?>)" /> Three Months</li>
	</ul>
	<div id="export-errors-results">
		<script type="text/javascript">get_export_errors(<?=time()-(7 * 24 * 60 * 60)?>);</script>
	</div>
</div>
-->
<div id="pending-deposits" class="view">
	<ul class="horz-nav time-choices">
		<li><input type="radio" name="when-pd" onclick="get_pending_deposits(<?=time()-(7 * 24 * 60 * 60)?>)" checked /> One Week</li>
		<li><input type="radio" name="when-pd" onclick="get_pending_deposits(<?=time()-(14 * 24 * 60 * 60)?>)" /> Two Week</li>
		<li><input type="radio" name="when-pd" onclick="get_pending_deposits(<?=time()-(30 * 24 * 60 * 60)?>)" /> One Month</li>
		<li><input type="radio" name="when-pd" onclick="get_pending_deposits(<?=time()-(90 * 24 * 60 * 60)?>)" /> Three Months</li>
	</ul>
	<div id="pending-deposits-results">
		<script type="text/javascript">get_pending_deposits(<?=time()-(7 * 24 * 60 * 60)?>);</script>
	</div>
</div>
<div id="recently-completed" class="view">
	<ul class="horz-nav time-choices">
		<li><input type="radio" name="when-rc" onclick="get_recently_completed(<?=time()-(7 * 24 * 60 * 60)?>)" checked /> One Week</li>
		<li><input type="radio" name="when-rc" onclick="get_recently_completed(<?=time()-(14 * 24 * 60 * 60)?>)" /> Two Week</li>
		<li><input type="radio" name="when-rc" onclick="get_recently_completed(<?=time()-(30 * 24 * 60 * 60)?>)" /> One Month</li>
		<li><input type="radio" name="when-rc" onclick="get_recently_completed(<?=time()-(90 * 24 * 60 * 60)?>)" /> Three Months</li>
	</ul>
	<div id="recently-completed-results">
		<script type="text/javascript">get_recently_completed(<?=time()-(7 * 24 * 60 * 60)?>);</script>
	</div>
</div>
<div id="lost-cards" class="view">
	<ul class="horz-nav time-choices">
		<li><input type="radio" name="when-lc" onclick="get_lost_cards(<?=time()-(7 * 24 * 60 * 60)?>)" checked /> One Week</li>
		<li><input type="radio" name="when-lc" onclick="get_lost_cards(<?=time()-(14 * 24 * 60 * 60)?>)" /> Two Week</li>
		<li><input type="radio" name="when-lc" onclick="get_lost_cards(<?=time()-(30 * 24 * 60 * 60)?>)" /> One Month</li>
		<li><input type="radio" name="when-lc" onclick="get_lost_cards(<?=time()-(90 * 24 * 60 * 60)?>)" /> Three Months</li>
	</ul>
	<div id="lost-cards-results">
		<script type="text/javascript">get_lost_cards(<?=time()-(7 * 24 * 60 * 60)?>);</script>
	</div>
</div>
<!-- show current section based off url hash. Used to make correct sections show when bookmarking and refreshing -->
<script type="text/javascript">if(location.hash=='#export-errors' || location.hash=='#pending-deposits' ||location.hash=='#recently-completed' || location.hash=='#lost-cards') switch_tabs(location.hash.substr(1));</script>
<?php 
mpbackweb_finish();
?>