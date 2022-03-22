

////////////////////Event handling////////
var isIE = document.all?true:false;

document.onmousedown = decide;
document.onmousemove = mouseMove;
document.onmouseup = letgo;




///////////////////global variables///////////////////
var instances = [];
var instance = 0;
var current_rows = [];
var current_cols = [];
var current_start = [];
var vorh = 'vertical';
var num_schedules = 1;
var boxSizex = 25;
var boxSizey =25;

var wrapOffset_top = 0;

var wrapOffset_top = 275;

var wrapOffset_left = 250;
var num_row = 14;
var num_col = 7;
var table_divs;
var maindiv = "wrap";
var divisions = 2;
var start_r = 0;
var colors = new Array(5);
colors[3] = '#003366';
colors[1] = 'red';
colors[2] = 'green';
colors[0] = '#FF6600';
colors[4] = 'purple';
colors[5] = 'black';
colors[6] = 'teal';
colors[7] = 'yellow';
colors[8] = 'pink';
colors[9] = 'grey';



////////////////////schedule////////////////////////

var schedule = [0];
schedule[0] = [0];
/* 
schedule[1] = [0];
schedule[2] = [0];
schedule[3] = [0];
schedule[4] = [0];
schedule[5] = [0];
*/
var zeroarray = [0, 1, 2, 3, 4, 5, 6];
zeroarray[0] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[1] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[2] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[3] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[4] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[5] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[6] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

var time = ['12am','1am', '2am', '3am', '4am', '5am', '6am', '<b>7am</b>', '<b>8am</b>', '<b>9am</b>', '<b>10am</b>', '<b>11am</b>', '<b>12pm</b>', '<b>1pm</b>', '<b>2pm</b>', '<b>3pm</b>', '<b>4pm</b>', '<b>5pm</b>', '<b>6pm</b>', '<b>7pm</b>', '<b>8pm</b>', '<b>9pm</b>', '<b>10pm</b>', '11pm', '12am'];


//var items = window.document.getElementById("col1");
var items = null;
var divs = 0;
var num=1;

var top1;
var left1;

var selecttop;
var selectleft;

var whichSchedule;




function init(div, vertical, num_sched, sizex, sizey, nrow, ncol, divis, start, rowh, colh, new_schedule, new_array){
 maindiv = div;
 vorh = vertical;
 num_schedules = num_sched;
 boxSizex = sizex;
 boxSizey = sizey;
// wrapOffset_top = set_top;
 //wrapOffset_left = set_left;
 num_row = nrow;
 num_col = ncol;
 
 divisions = divis;
 
 start_r = start;
//alert(instances);
if(new_schedule==1){
	
 instances[instances.length] = maindiv;
 if(new_array==1){
 schedule[instances.length-1][0]=[0, 1, 2, 3, 4, 5, 6];
schedule[instances.length-1][0][0] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][1] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][2] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][3] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][4] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][5] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[instances.length-1][0][6] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
 }
 
current_rows[instances.length-1] = nrow;
current_cols[instances.length-1] = ncol;
current_start[instances.length-1] = start;

instance = instances.length-1;

}
else{
	for ( var i in instances ){

		if(instances[i] == div){
			
			current_rows[i] = nrow;
			current_cols[i] = ncol;
			current_start[i] = start;
			instance = i;
		}
		
	}
	
}

 draw_table(rowh, colh);
 
 redraw_schedule();
	
}

function decide(e){
	
	if(over_schedule(e)==1){
	var mousePos = mouseCoords(e);

	//alert(mousePos.x+', '+mousePos.y);

	selecttop = parseInt(parseInt(mousePos.y-wrapOffset_top,10)/(boxSizey/divisions),10);


	selectleft =  parseInt(parseInt(mousePos.x-wrapOffset_left,10)/boxSizex,10);
 
	if(vorh=='vertical'){
		whichSchedule = parseInt((mousePos.x-wrapOffset_left-selectleft*boxSizex,10)/(boxSizex/num_schedules),10);

		var current = schedule[instance][whichSchedule][selectleft][selecttop+start_r];
		if(current!=1){
			new_timeblock(e);
		}
		else{

			schedule[instance][whichSchedule][selectleft][selecttop+start_r]=0;
		
			redraw_schedule();
		}
	}



	else{
		whichSchedule = parseInt((mousePos.y-wrapOffset_top-selecttop*boxSizey)/(boxSize/num_schedules))

		var current = schedule[instance][whichSchedule][selecttop][selectleft];

		if(current==0 || current==undefined){

		new_timeblock(e);
		}
		else{
		
		schedule[instance][whichSchedule][selecttop][selectleft]=0;
 		redraw_schedule();
 		}
 
	}
	}
 
return true;
 
}

function over_schedule(e){

var mousePos = mouseCoords(e);
var over;
for ( var i in instances )
{
	wrapOffset_top = document.getElementById(instances[i]).offsetTop;
	wrapOffset_left = document.getElementById(instances[i]).offsetLeft;
	if(mousePos.x <= (wrapOffset_left+(num_col*boxSizex)) && mousePos.x >= (wrapOffset_left) && mousePos.y <= (wrapOffset_top+(num_row*boxSizey)) && mousePos.y >= (wrapOffset_top)){
		over=1;
		maindiv = instances[i];
		instance = i;
		break;
	}
	else{
		over=0;
	}
	
}

num_row = current_rows[i];
num_col = current_cols[i];
start_r = current_start[i];

	//alert(instance);
return over;

}

function draw_table(rowh, colh){
	
	wrapOffset_top = document.getElementById(maindiv).offsetTop;
	wrapOffset_left = document.getElementById(maindiv).offsetLeft;
	
	
	

var table='';
var height2 = 1;

if(vorh=='vertical'){
	table += '<div style=" position:absolute; vertical-align:center; height:25px; width:75px; text-align:center; z-index:1000; left:-75px; top:-25px; padding-top:7px;"><strong>Time</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*0)+'px; top:-25px; padding-top:7px;"><strong>M</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*1)+'px; top:-25px; padding-top:7px;"><strong>T</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*2)+'px; top:-25px; padding-top:7px;"><strong>W</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*3)+'px; top:-25px; padding-top:7px;"><strong>R</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*4)+'px; top:-25px; padding-top:7px;"><strong>F</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*5)+'px; top:-25px; padding-top:7px;"><strong>S</strong></div>';
	table += '<div style=" position:absolute; height:25px; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*6)+'px; top:-25px; padding-top:7px;"><strong>S</strong></div>';
	
	table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+((num_col*boxSizex)+75)+'px; left:-75px; top:-25px; font-size:0px; overflow:hidden;"></div>';
	table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+((num_col*boxSizex)+75)+'px; left:-75px; top:-1px; font-size:0px; overflow:hidden;"></div>';
	table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+((num_row*boxSizey)+25)+'px; left:-75px; top:-25px;"></div>';
	table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+((num_col*boxSizex)+78)+'px; left:-76px; top:-26px; font-size:0px; overflow:hidden;"></div>';
	table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+((num_row*boxSizey)+28)+'px; left:-76px; top:-26px;"></div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-30px; top:-7px;">7am</div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-30px; top:19px;">8am</div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-30px; top:44px;">9am</div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-37px; top:69px;">10am</div>';
	for(i=0; i< (num_col/2); i++){
	table += '<div style="height:'+(num_row*boxSizey+25)+'px;  background-color:#99ccFF; position:absolute; z-index:10; width:'+(boxSizey)+'px; left:'+(i*boxSizey*2)+'px; top:-25px; font-size:0px; overflow:hidden;"></div>';
	}
	
	table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+((num_col*boxSizex)+77)+'px; left:-75px; top:'+((num_row*boxSizey)+1)+'px; font-size:0px; overflow:hidden;"></div>';
	
	table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+((num_row*boxSizey)+27)+'px; left:'+((num_col*boxSizex)+1)+'px; top:-25px;"></div>';
	
for(i=0; i < (num_row); i++){
		table += '<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:'+(12)+'px; top:'+(boxSizey*i)+'px;">'+time[i+(start_r/2)]+'</div>';
	}


for(i=0; i<(num_row+1); i++){

table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+((num_col*boxSizex)+76)+'px; left:-75px; top:'+((i*boxSizey))+'px; font-size:0px; overflow:hidden;"></div>';
}


for(i=0; i<num_col+1; i++){
 
table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+((num_row*boxSizey)+25)+'px; left:'+((i*boxSizex))+'px; top:-25px;"></div>';

}
}
else{
for(i=0; i<(num_col+1); i++){
table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+(num_row*boxSizex)+'px; left:0px; top:'+((i*boxSizey))+'px;"></div>';

}


for(i=0; i<num_row+1; i++){
table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+(num_col*boxSizey)+'px; left:'+((i*boxSizex))+'px; top:0px;"></div>';
}
}

table += '<div style="height:300px; width:150px; position:absolute; top:0px; left:-25; z-index:10000;"></div>';
//alert(table);
//document.getElementById('wrap').innerHTML+= table;
//alert(instance);
table_divs=table;

//redraw_schedule();
return true;


}




/*
function draw_table(rowh, colh){
	
	wrapOffset_top = document.getElementById(maindiv).offsetTop;
	wrapOffset_left = document.getElementById(maindiv).offsetLeft;
	
	
	

var table='';
var height2 = 1;

if(vorh=='vertical'){
	
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*0)+'px; top:-15px;">M</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*1)+'px; top:-15px;">T</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*2)+'px; top:-15px;">W</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*3)+'px; top:-15px;">R</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*4)+'px; top:-15px;">F</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*5)+'px; top:-15px;">S</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:'+((boxSizex)*6)+'px; top:-15px;">S</div>';
	for(i=0; i < (num_row+1); i++){
		table += '<div style=" position:absolute; z-index:1000; left:-37px; top:'+(boxSizey*i-7)+'px;">'+time[i+(start_r/2)]+'</div>';
	}
	
	//table += '<div style=" position:absolute; z-index:1000; left:-30px; top:19px;">8am</div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-30px; top:44px;">9am</div>';
	//table += '<div style=" position:absolute; z-index:1000; left:-37px; top:69px;">10am</div>';
	
for(i=0; i<(num_row+1); i++){

table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+(num_col*boxSizex)+'px; left:0px; top:'+((i*boxSizey))+'px; font-size:0px; overflow:hidden;"></div>';
}


for(i=0; i<num_col+1; i++){
 
table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+(num_row*boxSizey)+'px; left:'+((i*boxSizex))+'px; top:0px;"></div>';

}
}
else{
for(i=0; i<(num_col+1); i++){
table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+(num_row*boxSizex)+'px; left:0px; top:'+((i*boxSizey))+'px;"></div>';

}


for(i=0; i<num_row+1; i++){
table += '<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:'+(num_col*boxSizey)+'px; left:'+((i*boxSizex))+'px; top:0px;"></div>';
}
}

table += '<div style="height:'+(num_row*boxSizey+25)+'; width:'+(num_col*boxSizex+37)+'; position:absolute; top:-15px; left:-25; z-index:10000;"></div>';
//alert(table);
//document.getElementById('wrap').innerHTML+= table;
//alert(instance);
table_divs=table;

//redraw_schedule();
return true;


}
*/





function getPosition(e){

e = window.document.getElementById("col"+(num-1));

	var left = 0;
	var top  = 0;

	while (e.offsetParent){
		left += e.offsetLeft;
		top  += e.offsetTop;
		e     = e.offsetParent;
	}

	left += e.offsetLeft;
	top  += e.offsetTop;

	return {x:left, y:top};
}






function mouseMove(ev){


if(items != null){
	
	ev    = ev || window.event;
	 var mousePos = mouseCoords(ev);
	var topoff = getPosition(items);
	
	
	
	
	
	if(vorh=='vertical'){
	 items.style.height = String(mousePos.y - topoff.y)+"px";
	 
	 }else{
	
	 items.style.width = 0;
	 }
}


	
	
return false;	
	


}

function mouseCoords(e){
	/*
	if(ev.pageX || ev.pageY){
		return {x:ev.pageX, y:ev.pageY};
	}
	return {
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
		y:ev.clientY + document.body.scrollTop  - document.body.clientTop
	};
	*/
	var xpos;
	var ypos;
	if (!e) var e = window.event;

	if (e.pageX || e.pageY)
	{
		xpos = e.pageX;
		ypos = e.pageY;
	}
	else if (e.clientX || e.clientY)
	{
		xpos = e.clientX;
		ypos = e.clientY;
		if (document.body.scrollLeft || document.body.scrollTop)
		{
			xpos += document.body.scrollLeft;
			ypos += document.body.scrollTop;
		}
		else if (document.documentElement.scrollLeft || document.documentElement.scrollTop)
		{
			xpos += document.documentElement.scrollLeft;
			ypos += document.documentElement.scrollTop;
		}
	}
	return {x:xpos, y:ypos};
}








function new_timeblock(e){



if(items == null){


var mousePos = mouseCoords(e);


	 	 
top1 = parseInt(parseInt(mousePos.y-wrapOffset_top)/(boxSizey/divisions))*(boxSizey/divisions);
left1 =  parseInt(parseInt(mousePos.x-wrapOffset_left)/boxSizex)*boxSizex;

if(vorh=='vertical'){
 whichSchedule = parseInt((mousePos.x-left1-wrapOffset_left) /(boxSizex/num_schedules));
 schedule[instance][whichSchedule][left1/boxSizex][(top1/(boxSizey/divisions))+start_r] = 1;
 var left2 =left1 + whichSchedule*(boxSizex/num_schedules); 
 var temp_block = '<div class="col" id="col'+num+'" style="z-index:50; height:10px; position:absolute; width:'+((boxSizex/num_schedules)-6)+'px; _width:'+((boxSizex/num_schedules)-6)+'px; top:'+top1+'px; left:'+left2+'px; border:3px solid '+colors[whichSchedule]+';" onMouseDown="if(items==null){items=true;}" ondblclick="erase('+"'col"+num+"'); "+'test(' + "'col"+num+"')"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color: '+colors[whichSchedule]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
 }else{
 whichSchedule = parseInt((mousePos.y-top1-wrapOffset_top) /(boxSizey/num_schedules));
 schedule[instance][whichSchedule][top1/boxSizey][left1/boxSizex] = 1;
 var top2 =top1 + whichSchedule*(boxSizey/num_schedules);
 var temp_block = '<div class="col" id="col'+num+'" style="z-index:50; position:absolute; height:'+((boxSizey/num_schedules)-6)+'px; top:'+top2+'px; left:'+left1+'px; border:3px solid '+colors[whichSchedule]+';" onMouseDown="if(items==null){items=true;}" onclick="alert('+"'"+test+"'"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color: '+colors[whichSchedule]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
}

num += 1;

//alert(maindiv+" "+num);
document.getElementById(maindiv).innerHTML+= temp_block;

test('col'+(num-1));

}

return true;

}






function test(ids){
items = window.document.getElementById(ids);

}






function letgo(ev){



if(items != null){

var temp = items;

items = null;

if(vorh=='vertical'){

hour = parseInt(parseInt(temp.style.height)/(boxSizey/divisions));



for(i=0; i<=hour; i++){

var top2=top1/(boxSizey/divisions)+i;



schedule[instance][whichSchedule][left1/boxSizex][top2+start_r]=1;


}

temp.style.height = (hour+1)*(boxSizey/divisions)-6;
}
else{
hour = parseInt(parseInt(temp.style.width)/boxSizex);

for(i=0; i<=hour; i++){

var left2=left1/boxSizex+i;

schedule[instance][whichSchedule][top1/boxSizey][left2]=1;
}

temp.style.width = (hour+1)*boxSizex-6;

}

redraw_schedule();

}
return true;
}












function redraw_schedule(){


var divss = "";
// num = 1;


//alert(schedule);
var ttop=new Array(num_schedules);
var tleft=new Array(num_schedules);
var theight=new Array(num_schedules);

for(i=0; i<num_col; i++){
	//alert(num_row*divisions+start_r);
	
	for(m=start_r; m<(num_row*divisions+start_r); m++){
		
		//alert('hour:'+m);
	
		//alert(schedule[instance][0][i][m]);
		
		for(s=0; s<num_schedules; s++){
			
			if(schedule[instance][s][i][m] == 1 && (schedule[instance][s][i][m-1] == 0 || schedule[instance][s][i][m-1] == undefined || m==start_r)){
			
				if(vorh=='vertical'){
					ttop[s] = m-start_r;
					tleft[s] = i;
					//var endd = (num_row-1)*divisions;
					var endd = (num_row*divisions-1)+start_r;
				}
				else{
					ttop[s] = i;
					tleft[s] = m;
					var endd = (num_cols-1)*divisions;
				}
			
				//alert("start: "+i+", "+m);
				
				theight[s] = 1;
			}
			
			
			else{if(schedule[instance][s][i][m] == 1){
				theight[s] ++;
				//alert("length: "+theight[0]);
			}}
			
			
			if(((schedule[instance][s][i][m] == 0||schedule[instance][s][i][m] == undefined) && (schedule[instance][s][i][m-1] == 1))||(schedule[instance][s][i][m]==1 && m==endd)){
			//alert('end div: start('+tleft[s]+", "+ttop[s]+") - length: "+theight[s]);
			
				theight[s] = theight[s] * (boxSizey/divisions)-6;
			
				if(vorh=='vertical'){
					ttop[s] = ttop[s]*(boxSizey/divisions);
					tleft[s] = tleft[s]*boxSizex + (boxSizex/num_schedules)*s;
					divss += '<div class="col" id="col'+num+'" style=" z-index:50; position:absolute; width:'+((boxSizex/num_schedules)-6)+'px; _width:'+((boxSizex/num_schedules)-6)+'px; top:'+ttop[s]+'px; left:'+tleft[s]+'px; height:'+theight[s]+'px; _height:'+(theight[s])+'px; border:3px solid '+colors[s]+';" onMouseDown="if(items==null){items=true;}" ondblclick="erase('+"'col"+num+"'); "+'test(' + "'col"+num+"')"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color:'+colors[s]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
				}
				else{
					ttop[s] = ttop[s]*boxSize + (boxSizey/num_schedules)*s;
					tleft[s] = tleft[s]*boxSizex;
					divss += '<div class="col" id="col'+num+'" style="z-index:50; position:absolute; height:'+((boxSizey/num_schedules)-6)+'px; top:'+ttop[s]+'px; left:'+tleft[s]+'px; width:'+theight[s]+'px; border:3px solid '+colors[s]+';" onMouseDown="if(items==null){items=true;}" ondblclick="erase('+"'col"+num+"'); "+'test(' + "'col"+num+"')"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color: '+colors[s]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
					}
			
			
			num++;
			}
		}
	}


}

draw_table('', '');

document.getElementById(maindiv).innerHTML = divss + table_divs;



return true;
}