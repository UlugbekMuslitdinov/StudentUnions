

////////////////////Event handling////////
var isIE = document.all?true:false;
if (!isIE) document.captureEvents(Event.MOUSEDOWN);
if (!isIE) document.captureEvents(Event.KEYPRESS);


document.onmousedown = decide;
document.onmousemove = mouseMove;
document.onmouseup = letgo;




///////////////////global variables///////////////////
var vorh = 'vertical';
var num_schedules = 1;
var boxSizex = 25;
var boxSizey =25;
var wrapOffset_top = 275;
var wrapOffset_left = 250;
var num_row = 14;
var num_col = 7;
var table_divs;
var maindiv = "wrap";
var colors = new Array(5);
var divis = 2;
colors[0] = '#66CC33';
colors[1] = 'red';
colors[2] = 'green';
colors[3] = 'orange';
colors[4] = 'purple';
colors[5] = 'black';
colors[6] = 'teal';
colors[7] = 'yellow';
colors[8] = 'pink';
colors[9] = 'grey';



////////////////////schedule////////////////////////
var schedule=new Array(5);
schedule[0]=new Array(7);
schedule[0][0]=new Array(14);
schedule[0][1]=new Array(14);
schedule[0][2]=new Array(14);
schedule[0][3]=new Array(14);
schedule[0][4]=new Array(14);
schedule[0][5]=new Array(14);
schedule[0][6]=new Array(14);

var zeroarray = [0, 1, 2, 3, 4, 5, 6];
zeroarray[0] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[1] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[2] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[3] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[4] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[5] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
zeroarray[6] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];





//var items = window.document.getElementById("col1");
var items = null;
var divs = 0;
var num=1;

var top1;
var left1;

var selecttop;
var selectleft;

var whichSchedule;




function init(div, vertical, num_sched, sizex, sizey, nrow, ncol, rowh, colh, news){
 maindiv = div;
 vorh = vertical;
 num_schedules = num_sched;
 boxSizex = sizex;
 boxSizey = sizey;
// wrapOffset_top = set_top;
 //wrapOffset_left = set_left;
 num_row = nrow;
 num_col = ncol;
 
 if(news==1){
schedule[0][0]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][1]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][2]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][3]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][4]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][5]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
schedule[0][6]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	 
	 
 }
 
 draw_table(rowh, colh);
 
 redraw_schedule();
	
}

function decide(e){

	var mousePos = mouseCoords(e);


	 	 
 	selecttop = parseInt(parseInt(mousePos.y-wrapOffset_top)/(boxSizey/divis));


 	selectleft =  parseInt(parseInt(mousePos.x-wrapOffset_left)/boxSizex);
 
 	if(vorh=='vertical'){
 		whichSchedule = parseInt((mousePos.x-wrapOffset_left-selectleft*boxSizex)/(boxSizex/num_schedules));

		var current = schedule[whichSchedule][selectleft][selecttop];
		if(current!=1){
			new_timeblock(e);
		}
		else{

			schedule[whichSchedule][selectleft][selecttop]=0;
		
 			redraw_schedule();
 		}
	}



	else{
		whichSchedule = parseInt((mousePos.y-wrapOffset_top-selecttop*boxSizey)/(boxSize/num_schedules))

		var current = schedule[whichSchedule][selecttop][selectleft];

		if(current==0 || current==undefined){

		new_timeblock(e);
		}
		else{
		
		schedule[whichSchedule][selecttop][selectleft]=0;
 		redraw_schedule();
 		}
 
	}
 
return true;
 
}






function draw_table(rowh, colh){
	
	wrapOffset_top = document.getElementById(maindiv).offsetTop;
	wrapOffset_left = document.getElementById(maindiv).offsetLeft;
	
	
	

var table='';
var height2 = 1;

if(vorh=='vertical'){
	
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:0px; top:-15px;">M</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:25px; top:-15px;">T</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:50px; top:-15px;">W</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:75px; top:-15px;">R</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:100px; top:-15px;">F</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:125px; top:-15px;">S</div>';
	table += '<div style=" position:absolute; width:'+((boxSizex))+'px; text-align:center; z-index:1000; left:150px; top:-15px;">S</div>';
	table += '<div style=" position:absolute; z-index:1000; left:-30px; top:-7px;">7am</div>';
	table += '<div style=" position:absolute; z-index:1000; left:-30px; top:19px;">8am</div>';
	table += '<div style=" position:absolute; z-index:1000; left:-30px; top:44px;">9am</div>';
	table += '<div style=" position:absolute; z-index:1000; left:-37px; top:69px;">10am</div>';

for(i=0; i<(num_row+1); i++){

table += '<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:'+(num_col*boxSizex)+'px; left:0px; top:'+((i*boxSizey))+'px;"></div>';
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
//alert(table);
//document.getElementById('wrap').innerHTML+= table;

table_divs=table;

//redraw_schedule();
return true;


}






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
	
	 items.style.width = String(mousePos.x - topoff.x)+"px";
	 }
}

	
	
	
	


}

function mouseCoords(ev){
	/*
	if(ev.pageX || ev.pageY){
		return {x:ev.pageX, y:ev.pageY};
	}
	return {
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
		y:ev.clientY + document.body.scrollTop  - document.body.clientTop
	};
	*/
	
	if (isIE) { // grab the x-y pos.s if browser is IE
tempX = event.clientX + document.body.scrollLeft;
tempY = event.clientY + document.body.scrollTop;
}
else {  // grab the x-y pos.s if browser is NS
tempX = ev.pageX;
tempY = ev.pageY;
}  
if (tempX < 0){tempX = 0;}
if (tempY < 0){tempY = 0;}  

return {x:tempX, y:tempY};
}








function new_timeblock(e){



if(items == null){


var mousePos = mouseCoords(e);


	 	 
top1 = parseInt(parseInt(mousePos.y-wrapOffset_top)/(boxSizey/divis))*(boxSizey/divis);
left1 =  parseInt(parseInt(mousePos.x-wrapOffset_left)/boxSizex)*boxSizex;

if(vorh=='vertical'){
 whichSchedule = parseInt((mousePos.x-left1-wrapOffset_left) /(boxSizex/num_schedules));
 schedule[whichSchedule][left1/boxSizex][top1/(boxSizey/divis)] = 1;
 var left2 =left1 + whichSchedule*(boxSizex/num_schedules); 
 var temp_block = '<div class="col" id="col'+num+'" style="z-index:50; height:10px; position:absolute; width:'+((boxSizex/num_schedules)-6)+'px; top:'+top1+'px; left:'+left2+'px; border:3px solid '+colors[whichSchedule]+';" onMouseDown="if(items==null){items=true;}" ondblclick="erase('+"'col"+num+"'); "+'test(' + "'col"+num+"')"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color: '+colors[whichSchedule]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
 }else{
 whichSchedule = parseInt((mousePos.y-top1-wrapOffset_top) /(boxSizey/num_schedules));
 schedule[whichSchedule][top1/boxSizey][left1/boxSizex] = 1;
 var top2 =top1 + whichSchedule*(boxSizey/num_schedules);
 var temp_block = '<div class="col" id="col'+num+'" style="z-index:50; position:absolute; height:'+((boxSizey/num_schedules)-6)+'px; top:'+top2+'px; left:'+left1+'px; border:3px solid '+colors[whichSchedule]+';" onMouseDown="if(items==null){items=true;}" onclick="alert('+"'"+test+"'"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color: '+colors[whichSchedule]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
}

num += 1;


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

hour = parseInt(parseInt(temp.style.height)/(boxSizey/divis));



for(i=0; i<=hour; i++){

var top2=top1/(boxSizey/divis)+i;



schedule[whichSchedule][left1/boxSizex][top2]=1;


}

temp.style.height = (hour+1)*(boxSizey/divis)-6;
}
else{
hour = parseInt(parseInt(temp.style.width)/boxSizex);

for(i=0; i<=hour; i++){

var left2=left1/boxSizex+i;

schedule[whichSchedule][top1/boxSizey][left2]=1;
}

temp.style.width = (hour+1)*boxSizex-6;

}

redraw_schedule();

}
return true;
}












function redraw_schedule(){


var divss = "";
 num = 1;



var ttop=new Array(num_schedules);
var tleft=new Array(num_schedules);
var theight=new Array(num_schedules);

for(i=0; i<num_col; i++){
	//alert('day:'+i);
	
	for(m=0; m<num_row; m++){
	
		//alert('hour:'+m);
		
		//alert(schedule[i][m]+", "+schedule[i][m-1]);
		
		for(s=0; s<num_schedules; s++){
		
			if(schedule[s][i][m] == 1 && (schedule[s][i][m-1] == 0 || schedule[s][i][m-1] == undefined || m==0)){
			
				if(vorh=='vertical'){
					ttop[s] = m;
					tleft[s] = i;
					var endd = num_row-1;
				}
				else{
					ttop[s] = i;
					tleft[s] = m;
					var endd = num_cols-1;
				}
			
				//alert("start: "+i+", "+m);
				
				theight[s] = 1;
			}
			
			
			else{if(schedule[s][i][m] == 1){
				theight[s] ++;
				//alert("length: "+theight[s]);
			}}
			
			
			if(((schedule[s][i][m] == 0||schedule[s][i][m] == undefined) && (schedule[s][i][m-1] == 1))||(schedule[s][i][m]==1 && m==endd)){
			//alert('end div: start('+tleft[s]+", "+ttop[s]+") - length: "+theight[s]);
			
				theight[s] = theight[s] * boxSizey-6;
			
				if(vorh=='vertical'){
					ttop[s] = ttop[s]*boxSizey;
					tleft[s] = tleft[s]*boxSizex + (boxSizex/num_schedules)*s;
					divss += '<div class="col" id="col'+num+'" style=" z-index:50; position:absolute; width:'+((boxSizex/num_schedules)-6)+'px; top:'+ttop[s]+'px; left:'+tleft[s]+'px; height:'+theight[s]+'px; border:3px solid '+colors[s]+';" onMouseDown="if(items==null){items=true;}" ondblclick="erase('+"'col"+num+"'); "+'test(' + "'col"+num+"')"+'"><div id="coli'+num+'" style="width:100%; height:100%; background-color:'+colors[s]+'; opacity: .75; filter:alpha(opacity=75);"></div></div>';
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


document.getElementById(maindiv).innerHTML = divss + table_divs;



return true;
}