<style>
.table_title {
	font-size: 20px;
	font-weight: bold;
	color: #3E5A33; 
	padding-right: 15px;
}
#restaurant_bg {
	width:230px;
	border-style: solid;
    border-width: 1px;
	border-color: #3E5A33;
	border-style: groove;
	border-radius: 5px;
	background-color: #EAF3D3;
	margin-top: 10px;
	margin-left: 10px;
	margin-bottom: 10px;
	margin-right: 5px;
	padding: 5px;	
}
.restaurant {
	color: #3E5A33;
}
#restaurant_title a:active, #restaurant_title a:link,  #restaurant_title a:visited {
	font-size:16px;
	font-weight: bold;
	color: #E20307;
	text-decoration:underline;
	display:inline;
}
#restaurant_title a:hover{
	font-size:16px;
	font-weight: bold;
	color: #F58523;
	text-decoration:underline;
	display:inline;
}

@media only screen and (max-width: 600px) {
  .table {
    width: 100%;
  }
  .table td {
    padding: 5px;
    width: 50%;
  }
  #restaurant_bg {
    margin: 0px;
    margin-bottom: 10px;
    padding: 0px;
    width: 100%;
    text-align: center;
  }
}
</style>
<h1><?=$title?></h1>
<div style="margin-top:-20px; margin-bottom:20px; font-weight:bold; font-size:14px; color:#F58523;">West Side of Campus</div>


<table class="table" width="575" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="50%" align="center" class="table_title">
  		STREET LEVEL
      </td>
      <td width="50%" align="center" class="table_title">
  		UPPER LEVEL
      </td>
    </tr>
    <tr>
      <td width="50%" align="left" valign="top">
      	<div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/bageltalk/" >Bagel Talk</a></div><hr />
          Features a large selection of gourmet bagels, cream cheese, breakfast bagel sandwiches, and piping hot coffee: 
          <a href="/dining/template/resources/BagelTalk.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>
          <!--<a href="menu.php?unit=bageltalk" rel="shadowbox;height=500;width=600" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>-->
      	</div>
      	<div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/lapetite/" >La Petite Patisserie</a></div><hr />
          Freshly baked pastries, sweet and savory crepes, fruit smoothies, and coffee and espresso: 
          <a href="/dining/template/resources/LaPetite.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>
          <!--<a href="menu.php?unit=lapetite" rel="shadowbox;height=500;width=600" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>-->          
      	</div>
        <div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/corepsu/" >Core+</a></div><hr />
          Core is designed to offer healthy, tasty and unique food options, as well as gluten-free choices, that meet your needs: 
          <a href="/dining/template/resources/CorePlus.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>
          <!--<a href="menu.php?unit=corepsu" rel="shadowbox;height=500;width=600" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>-->
      	</div>
        <div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/parkmarket/" >Park Avenue Market</a></div><hr />
          The expanded retail experience boasts everything from typical convenience store fare to frozen yogurt, Red & Blue favorites and snacks to college swag like t-shirts, school supplies, UA gifts and more.
      	</div>
      </td>
      <td width="50%" align="left" valign="top">
      	<div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/nosh/" >Nosh</a></div><hr />
          Menu to be added soon!
           <!--<a href="menu.php?unit=nosh" rel="shadowbox;height=500;width=600" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>--> 
      	</div>
      	
        <div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/ondeck2/" >On Deck Deli 2</a></div><hr />  
          Menu Updated:           
          <a href="/dining/template/resources/OnDeck2.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a> 
      	</div>
        <div id="restaurant_bg"> 
 		  <div align="center" id="restaurant_title"><a href="/dining/psu/theden/" >The Den</a></div><hr />
          Menu Updated!  Tapingo PickUp and Delivery available:
          <a href="/dining/template/resources/TheDen.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>  
      	</div>
		<div id="restaurant_bg"> 
			<div align="center" id="restaurant_title"><a href="/dining/psu/nrichexpress/" >N<sup>RICH</sup> Urban Market Express</a></div><hr />
          A variety of fresh pressed juices, ground nut butter, infused water, brewed tea & botanicals, probiotic rich frozen yogurt, and grab n' go meals & snacks.
          <!--<a href="/dining/template/resources/TheDen.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>Menu</u></a>  -->
      	</div>
      </td>
    </tr>
  </tbody>
</table>
