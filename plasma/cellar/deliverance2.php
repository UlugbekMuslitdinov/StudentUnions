<?php
  ###########################################
  # required for all pages using DELIVERANCE #
  ############################################
  
  // enables 'edit | view' options to appear for authorized users
  session_start();
  
  // includes the display functions
  include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");
  
  // connect to database
  include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");

  // select database
  mysql_select_db("deliverance", $DBlink)
  or die(mysql_error());
  
  ################################
  # end DELIVERANCE requirements #
  ################################

  $menuID = $_GET['menuID'];
?>

<script type="text/javascript">
var minBump=0;
var hBump=0;
var inter;
var current = 'menu_1';

var today = new Date(); //Gets the current date info
today.setHours(today.getHours() + hBump);
today.setMinutes(today.getMinutes() + minBump);

var dayofweek = today.getDay();

function trimWhite(str) {
  var chars = new Array(' ', '\t', '\n', '\r');
  return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
  chars = chars || "\\s";
  return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
  chars = chars || "\\s";
  return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function switch_onreload(curmenu){
  var h=today.getHours();
  document.getElementById('menu_1').style.opacity =0;
  document.getElementById('menu_2').style.opacity =0;
  document.getElementById('menu_3').style.opacity =0;
  if(curmenu == null || curmenu == '' ) {
    if( h>=20 || h<6 || dayofweek==6 || dayofweek == 0) {
      curmenu = 'menu_3';
    }
    else {
      curmenu = 'menu_1'; // this should be menu_1, just using 3 for testing
    }
  }
  document.getElementById(curmenu).style.opacity =1;
  current=curmenu;
}

function switch_images(){
  opacity=1;
   console.log('switching image');
  inter = setInterval(change_op, 25);

}
var opacity;
function change_op(){
  var menu_1 = document.getElementById('menu_1');
  var menu_2 = document.getElementById('menu_2');
  var menu_3 = document.getElementById('menu_3');
  var menu_4 = document.getElementById('menu_4');
  
  today = new Date(); //Gets the current date info
  today.setHours(today.getHours() + hBump);
  today.setMinutes(today.getMinutes() + minBump);

  dayofweek = today.getDay();
  
  h=today.getHours();
  
  if( h>=20 || h<6 || dayofweek==6 || dayofweek == 0) {
  	 console.log('is late night');
    if (current!='menu_3' && current!='menu_4') {
      if(current=='menu_1'){
        if(menu_1.style.opacity <= 0){
          clearInterval(inter);
          current = 'menu_3';
          menu_1.childNodes[0].src = '';
        }
        else{
         opacity -= .05;
          menu_1.style.opacity  = opacity;
          document.getElementById('menu_3').style.opacity = 1-menu_1.style.opacity;
        }
      }
      else{
        if(menu_2.style.opacity <= 0){
          clearInterval(inter);
          current = 'menu_3';
          menu_2.childNodes[0].src = '';
        }
        else{
         opacity -= .05;
          menu_2.style.opacity  = opacity;
          document.getElementById('menu_3').style.opacity = 1-menu_2.style.opacity;
        }
      }
    }
    else{
    	console.log('on late night');
    	if(current=='menu_3'){
        if(menu_3.style.opacity <= 0){
          clearInterval(inter);
          current = 'menu_4';
          //menu_1.childNodes[0].src = '';
        }
        else{
          opacity -= .05;
          menu_3.style.opacity = opacity;
          document.getElementById('menu_4').style.opacity = 1-opacity;
        }
      }
      else{
        if(menu_4.style.opacity <= 0){
          clearInterval(inter);
          current = 'menu_3';
          //menu_2.childNodes[0].src = '';
        }
        else{
         opacity -= .05;
          menu_4.style.opacity  = opacity;
          document.getElementById('menu_3').style.opacity = 1-menu_4.style.opacity;
        }
      }
    }
  }
  else {
    if(current=='menu_1'){
      if(menu_1.style.opacity <= 0){
        clearInterval(inter);
        current = 'menu_2';
        menu_1.childNodes[0].src = '';
      }
      else{
       opacity -= .05;
        menu_1.style.opacity  = opacity;
        document.getElementById('menu_2').style.opacity = 1-menu_1.style.opacity;
      }
    }
    else if(current=='menu_3') {
      if(menu_3.style.opacity <= 0){
        clearInterval(inter);
        current = 'menu_1';
        menu_3.childNodes[0].src = '';
      }
      else{
       opacity -= .05;
        menu_3.style.opacity  = opacity;
        document.getElementById('menu_1').style.opacity = 1-menu_3.style.opacity;
      }
    }
    else if(current=='menu_4') {
      if(menu_4.style.opacity <= 0){
        clearInterval(inter);
        current = 'menu_1';
        menu_4.childNodes[0].src = '';
      }
      else{
       opacity -= .05;
        menu_4.style.opacity  = opacity;
        document.getElementById('menu_1').style.opacity = 1-menu_4.style.opacity;
      }
    }
    else{
      if(menu_2.style.opacity <= 0){
        clearInterval(inter);
        current = 'menu_1';
        menu_2.childNodes[0].src = '';
      }
      else{
       opacity -= .05;
        menu_2.style.opacity  = opacity;
        document.getElementById('menu_1').style.opacity = 1-menu_2.style.opacity;
      }
    }
  }
}

function startTime()
{
var today=new Date();
today.setHours(today.getHours() + hBump);
today.setMinutes(today.getMinutes() + minBump);
var hour=today.getHours();
var m=today.getMinutes();
var tod='';


if (hour<12) {
  tod='AM';
}
else {
  tod='PM ';
}
if (hour>12) {
  hour-=12;
}
if (hour==0) {
  hour=12;
}
m=checkTime(m);
document.getElementById('clock').innerHTML=hour+":"+m+" "+tod;
t=setTimeout('startTime()',5000);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}

function check_connection_and_reload(){
    var xmlHttp;
    
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }

xmlHttp.onreadystatechange = function() {
  if(xmlHttp.readyState==4) {
    testResponse = xmlHttp.responseText;
    testResponse = testResponse.toLowerCase();
    testResponse = trimWhite(testResponse);
    if(testResponse=='success') {
      window.location='./deliverance.php?menuID='+current;
    }
  }
};
xmlHttp.open("POST", './test.php', true);
xmlHttp.send('');
  
}
</script>

<html>
<style>
* {cursor: none;}
body {
  margin:0px;
  padding:0px;
  background-color:#000000;
  overflow:hidden;
  cursor:none;
}
.content {
  margin:0px;
  padding:0px;
  font-family:"Helvetica Neue";
  z-index:0;
}
#clock_wrap{
  background-color:#000000;
  position:absolute;
  top:669px;
  left:1201px;
  z-index:1;
  padding:6px;
  -webkit-border-radius:5px;
  -moz-border-radius:5px;
}
#clock{
  color:#b3aaab;
  opacity:1;
  z-index:2;
  font-family:"Helvetica Neue";
}
</style>

<body onLoad="startTime()">
  <div class="content">
    
    
    <div id="menu_1" style="opacity:1; width:1280px; height:720px; background-color:#f7941d;position:absolute; top:0px; left:0px;">
    <?php staticfeed(33); ?>
    </div>
    <div id="menu_2" style="opacity:0; width:1280px; height:720px; background-color:#4b271b;position:absolute; top:0px; left:0px;">
    <?php staticfeed(34); ?>
    </div>
    <div id="menu_3" style="opacity:0; width:1280px; height:720px; background-color:#1f3533;position:absolute; top:0px; left:0px;"> 
    <?php staticfeed(35); ?>
    </div>
     <div id="menu_4" style="opacity:0; width:1280px; height:720px; background-color:#1f3533;position:absolute; top:0px; left:0px;"> 
    <?php staticfeed(44); ?>
    </div>
    
  </div>  
    <div id="clock_wrap">
    <div id="clock"></div></div>
</body>
</html>

<script type="text/javascript">
switch_onreload( <?php echo '"'.$menuID.'"'; ?> );
setInterval(switch_images, 15000);
//check_connection_and_reload();
//setInterval(check_connection_and_reload, 10000);
setInterval(check_connection_and_reload, 300000);
</script>
<?php echo '<div style="position:absolute;top:750px;color:#FFF;">Last loaded on '.date("d/m/y @ H:i:s", time())."</div>"; ?>
