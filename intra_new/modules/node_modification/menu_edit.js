$(document).ready(function() {
$("#edit-title").change(function(){
document.getElementById("current_item").innerHTML = this.value;

});



 //  $("#edit-submit").click(function(){
$("#edit-submit").mouseover(function(){
var len1 = $("#menu_tree1 > div").length;
var len2 = $("#menu_tree1 > div > div").length;
var len3 = $("#menu_tree1 > div > div > div").length;
var a=0;
var x=[];

for(i=0; i< len1; i++){
     var title1 = $("#menu_tree1").children("div")[i].id;
if(title1=="current_item"){
	title1 = document.getElementById("current_item").innerHTML;
}
     //alert($("#menu_tree1 > div").parent()[0].id);

x[a++] = title1;
x[a++]= 0; 

}





for(i=0; i< len2; i++){
     var title2 = $("#menu_tree1 > div > div")[i].id;

if(title2=="current_item"){
	title2 = document.getElementById("current_item").innerHTML;
}
var pid2 = $("#menu_tree1 > div > div")[i].parentNode.id;
//var ids = "#" + $("#menu_tree1 > div > div")[i].id;


     //pid2 =$(ids).parent()[0].id;
//alert(pid2 + ids1);
x[a++]=title2;
x[a++]=pid2;
//alert(title2+pid2+a);
}
//alert("done with 2");

for(i=0; i< len3; i++){
    var  title3 = $("#menu_tree1 > div > div > div")[i].id;
if(title3=="current_item"){
	title3 = document.getElementById("current_item").innerHTML;
}
var pid3 = $("#menu_tree1 > div > div > div")[i].parentNode.id;
//var ids = "#" + $("#menu_tree1 > div > div > div")[i].id
    // pid3 = $(ids).parent()[0].id;

x[a++]=title3;
x[a++]=pid3;
}

alert(x);

$.post("/Intra2/edit_menu", {"items[]": x });


   });
 });

var isIE = document.all?true:false;
if (!isIE) document.captureEvents(Event.MOUSEDOWN);
//if (!isIE) document.captureEvents(Event.KEYPRESS);
document.onmousedown = select_item;
document.onmousemove = mouseMove;
document.onmouseup = unselect_item;
//document.onclick = select;
var menu_item = null;
var tree = [];
function select_item(e){
var items = document.getElementById("menu_tree1").getElementsByTagName("div");
e= e || window.event;
 var mousePos = mouseCoords(e);
var topoff = getPosition(e);
var height = document.getElementById("menu_tree1").getElementsByTagName("div").length*15;
if(mousePos.y < (topoff.y + height) && mousePos.y > topoff.y && mousePos.x < (topoff.x + parseInt(document.getElementById("menu_tree1").style.width)) && mousePos.x > topoff.x){

var order = parseInt((mousePos.y-topoff.y)/15);



menu_item = items[order];

menu_item.className = "menu_select";


 //menu_item = document.getElementById(item_clicked);


 
 

//document.getElementById("menu").removeChild(menu_item);


 //menu_item.parentNode.removeChild(menu_item);



 
tree = document.getElementById("menu_tree1").getElementsByTagName("div");




//menu_item.style.backgroundColor = "teal";




mouseMove();


//alert("yes : "+menu_item);
}

}

function unselect_item(){

//alert("no")



menu_item.className = "";

//menu_item.style.backgroundColor = "white";


menu_item = null;




}

function getPosition(e){


e = window.document.getElementById("menu_tree1");



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



	ev    = ev || window.event;

	 var mousePos = mouseCoords(ev);

	var topoff = getPosition(menu_item);

//alert(document.getElementById("menu_tree1").offsetHeight);
var height = document.getElementById("menu_tree1").getElementsByTagName("div").length*15;
if(mousePos.y < (topoff.y + height) && mousePos.y > topoff.y && mousePos.x < (topoff.x + parseInt(document.getElementById("menu_tree1").style.width)) && mousePos.x > topoff.x){

	var inv = document.getElementById("invisible");
	inv.style.top = String(mousePos.y-10)+"px";
	inv.style.left = String(mousePos.x-10)+"px";

if(menu_item != null){

	
	var menu_div = document.getElementById("menu_tree1");

	
var 	order = parseInt((mousePos.y-topoff.y)/15);

var is_child = parseInt((mousePos.x-topoff.x)/20)*20;

//var inv = document.getElementById("invisible");



inv.style.top = String(mousePos.y-10)+"px";

inv.style.left = String(mousePos.x-10)+"px";

//inv.offsetTop = mousePos.y-10;
//inv.offsetLeft = mousePos.x-10;

//alert(order);

mousePos.x-=topoff.x		
	
	
	 //items.style.height = mousePos.y - topoff.y;



if(order>tree.length-1){
order=tree.length;
}




//menu_div.insertBefore(menu_item, tree[order]);


if(tree.length==document.getElementById("menu_tree1").getElementsByTagName("div").length){
menu_item.parentNode.removeChild(menu_item);
}

//if(tree[order]){

if(mousePos.x > 80 && order>1 && tree[order-1].parentNode.parentNode == menu_div ){
	if(tree[order-1].childNodes.length>1){
		tree[order-1].insertBefore(menu_item, tree[order-1].childNodes[1]);
	}
	else{
		tree[order-1].appendChild(menu_item);
	}
}
else if(mousePos.x > 80 && order>2 && tree[order-1].parentNode.parentNode.parentNode == menu_div && !(tree[order-1].nextSibling)){

	tree[order-1].parentNode.appendChild(menu_item);
}
else if(mousePos.x > 60 && order > 2 && tree[order-1].parentNode.parentNode.parentNode == menu_div && !(tree[order-1].nextSibling)){
	tree[order-1].parentNode.parentNode.appendChild(menu_item);
}


else if(mousePos.x > 60 && order!=0 && tree[order-1].parentNode == menu_div ){

	if(tree[order-1].childNodes.length>1){
		tree[order-1].insertBefore(menu_item, tree[order-1].childNodes[1]);
	}
	else{
		tree[order-1].appendChild(menu_item);
	}
}
else if(mousePos.x > 60 && order>1 && tree[order-1].parentNode.parentNode == menu_div && !(tree[order-1].nextSibling)){

	tree[order-1].parentNode.appendChild(menu_item);
}
else if(tree[order]){

tree[order].parentNode.insertBefore(menu_item, tree[order]);
}
else{

//tree[tree.length-1].parentNode.appendChild(menu_item);
menu_div.appendChild(menu_item);
}
/*}
else{
alert("probably this");
menu_div.appendChild(menu_item);
}*/



	//menu_item.style.marginLeft = is_child;




}

}


}

function mouseCoords(ev){
	if(ev.pageX || ev.pageY){
		return {x:ev.pageX, y:ev.pageY};
	}
	return {
		x:ev.clientX + document.documentElement.scrollLeft - document.documentElement.clientLeft,
		y:ev.clientY + document.documentElement.scrollTop  - document.documentElement.clientTop
	};
}