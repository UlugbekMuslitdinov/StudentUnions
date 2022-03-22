<style>
	.line-item {
		margin-bottom: 8px;
		line-height: 14px;
	}

	.line-item div{
		width:420px;
	}

	.group {
		margin-bottom: 10px;
	}

	.group .line-item {
		font-weight: normal;
		margin-bottom: 0;
	}

	.group .line-item:first-child {
		font-weight: bold;
	}
</style>
<div id="nav" >
	<span class="active" onclick="show('breakfast')" id="breakfast-link" >Breakfast</span> :
	<span onclick="show('lunch_dinner')" id="lunch_dinner-link" >Lunch &amp; Dinner</span> :
	<span onclick="show('salads_sides')" id="salads_sides-link" >Salads &amp; Sides</span>
	<script>var current='breakfast';</script>
</div>
<!--
<div id="logo">
	<img src="template/images/logos/sabor.jpg" alt="Sabor"/>
</div>
-->
<div id="desc" >
	<p>&nbsp;</p>
    <p>
		<strong>Menu will be updated soon!</strong>
	</p>
</div>
