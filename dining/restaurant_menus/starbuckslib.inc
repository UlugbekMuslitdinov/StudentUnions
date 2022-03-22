<?php
//require_once('db.inc');
//db_connect();
//db_select('menuboards');
?>
<style>
.tb_head {
	color: #F5F5F5;
	background-color: #036635;
	font-size:14px;
	font-weight: bold;
}
.tb_body {
	font-size:12px;
	background-color:#B8D8A2;
}

</style>
<!--<div id="nav" style="position:absolute; top:20px; right:10px;">-->
<div id="nav" style="">
	<span class="active" onclick="show('1')" id="1-link" >Coffee</span> |
    <span onclick="show('2')" id="2-link">Espresso</span> |
	<span onclick="show('3')" id="3-link">Teas</span> |
	<span onclick="show('4')" id="4-link">Refreshers</span> |
	<span onclick="show('5')" id="5-link">Frappuccino</span> |&nbsp;&nbsp;&nbsp;
	<script>var current='1';</script>
</div>
<div id="logo">
	<img src="template/images/logos/starbucks.gif" alt="StarBucks"/>
</div>
<div id="desc" >
	<p>
	</p>
</div>
<div id="menu-content" style="clear:both; padding-top:10px;">
<div id="1" style="display:block;">
	<h1>Coffee</h1>
    <table width="530" border="0" cellpadding="5">
      <tbody>
        <tr class="tb_head">
          <td>Coffee</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
        </tr>
        <tr class="tb_body">
          <td>Freshly Brewed</td>
          <td align="center">$2.15</td>
          <td align="center">$2.45</td>
          <td align="center">$2.65</td>
        </tr>
        <tr class="tb_body">
          <td>Iced Coffee</td>
          <td align="center">$2.65</td>
          <td align="center">$3.15</td>
          <td align="center">$5.75</td>
        </tr>
        <tr class="tb_body">
          <td>Cold Brew</td>
          <td align="center">$2.95</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
        </tr>
        <tr class="tb_body">
          <td>Vanilla Sweet Cream Cold Brew</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
          <td align="center">$4.25</td>
        </tr>
      </tbody>
    </table>
</div>

<div id="2" style="display:none;">
	<h1>Espresso Beverages</h1>
    <table width="530" border="0" cellpadding="3">
      <tbody>
        <tr class="tb_head">
          <td>Espresso Beverages</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
        </tr>
        <tr class="tb_body">
          <td>Flat White</td>
          <td align="center">$4.45</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr class="tb_body">
          <td>Latte Macchiato</td>
          <td align="center">$4.45</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr class="tb_body">
          <td>Caffe latte</td>
          <td align="center">$3.75</td>
          <td align="center">$4.25</td>
          <td align="center">$4.75</td>
        </tr>
        <tr class="tb_body">
          <td>Caramel Macchiato</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
          <td align="center">$5.45</td>
        </tr>
        <tr class="tb_body">
          <td>Iced Caramel Macchiato</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
          <td align="center">$5.45</td>
        </tr>
        <tr class="tb_body">
          <td>Stabucks Double Shot</td>
          <td align="center">$3.25</td>
          <td align="center">$3.75</td>
          <td align="center">$4.45</td>
        </tr>
        <tr class="tb_body">
          <td>White Chocolate Mocha</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
          <td align="center">$5.45</td>
        </tr>
        <tr class="tb_body">
          <td>Caffe Mocha</td>
          <td align="center">$4.25</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
        </tr>
        <tr class="tb_body">
          <td>Caffe Americano</td>
          <td align="center">$2.65</td>
          <td align="center">$3.25</td>
          <td align="center">$3.45</td>
        </tr>
        <tr class="tb_body">
          <td>Cappuccino</td>
          <td align="center">$3.75</td>
          <td align="center">$4.25</td>
          <td align="center">$4.75</td>
        </tr>
      </tbody>
    </table>
</div>

<div id="3" style="display:none;">
	<h1>Handcrafted Teas</h1>
    <table width="530" border="0" cellpadding="3">
      <tbody>
        <tr class="tb_head">
          <td>Handcrafted Teas</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
          <td width="60" align="center">Trenta</td>
        </tr>
        <tr class="tb_body">
          <td>Shaken Iced Tea</td>
          <td align="center">$2.25</td>
          <td align="center">$2.75</td>
          <td align="center">$2.95</td>
          <td align="center">$3.25</td>
        </tr>
        <tr class="tb_body">
          <td>Black, Green or Passion</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr class="tb_body">
          <td>Shaken Iced Tea Lemonade</td>
          <td align="center">$2.95</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
          <td align="center">$4.45</td>
        </tr>
        <tr class="tb_body">
          <td> Black, Green or Passion</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </tbody>
    </table>

	<h1>Teavana Full-Leaf Brewed Tea</h1>
    <table width="530" border="0" cellpadding="3">
      <tbody>
        <tr class="tb_head">
          <td>Teavana Full-Leaf Brewed Tea</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
        </tr>
        <tr class="tb_body">
          <td>Black Tea</td>
          <td align="center">$2.45</td>
          <td align="center">$2.75</td>
          <td align="center">$2.95</td>
        </tr>
        <tr class="tb_body">
          <td>Green & White Tea</td>
          <td align="center">$2.45</td>
          <td align="center">$2.75</td>
          <td align="center">$2.95</td>
        </tr>
        <tr class="tb_body">
          <td>Caffeine-Free Herbal Tea</td>
          <td align="center">$2.45</td>
          <td align="center">$2.75</td>
          <td align="center">$2.95</td>
        </tr>
      </tbody>
    </table>
</div>

<div id="4" style="display:none;">
	<h1>Starbucks Refreshers</h1>
    <table width="530" border="0" cellpadding="5">
      <tbody>
        <tr class="tb_head">
          <td>Starbucks Refreshers</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
          <td width="60" align="center">Trenta</td>
        </tr>
        <tr class="tb_body">
          <td>Strawberrt Acai</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
        </tr>
        <tr class="tb_body">
          <td>Very Berry Hisbiscus</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
        </tr>
        <tr class="tb_body">
          <td>Coo Lime</td>
          <td align="center">$3.45</td>
          <td align="center">$3.95</td>
          <td align="center">$4.45</td>
          <td align="center">$4.95</td>
        </tr>
      </tbody>
    </table>
</div>

<div id="5" style="display:none;">
	<h1>Frappuccino</h1>
    <table width="530" border="0" cellpadding="3">
      <tbody>
        <tr class="tb_head">
          <td>Frappuccino</td>
          <td width="60" align="center">Tall</td>
          <td width="60" align="center">Grande</td>
          <td width="60" align="center">Venti</td>
        </tr>
        <tr class="tb_body">
          <td>Caramel</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        </tr>
        <tr class="tb_body">
          <td>Mocha</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        </tr>
        <tr class="tb_body">
          <td>Coffee</td>
          <td align="center">$4.25</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
        </tr>
        <tr class="tb_body">
          <td>Java Chip</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        </tr>
        <tr class="tb_body">
          <td>Vanilla bean Crème</td>
          <td align="center">$4.25</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
        </tr>
        <tr class="tb_body">
          <td>Double Chocolaty Chip</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        </tr>
        <tr class="tb_body">
          <td>Green Tea</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        <tr class="tb_body">
          <td>Strawberries & Crème</td>
          <td align="center">$4.75</td>
          <td align="center">$5.25</td>
          <td align="center">$5.75</td>
        </tr>
      </tbody>
    </table>
</div>
</div>
