var aySound = new Array();
// Below: source for sound files to be preloaded
aySound[0] = "images/birds007.wav";

// DO NOT edit below this line
document.write('<BGSOUND ID="auIEContainer">')
IE = (navigator.appVersion.indexOf("MSIE")!=-1 && document.all)? 1:0;
NS = (navigator.appName=="Netscape" && navigator.plugins["LiveAudio"])? 1:0;
ver4 = IE||NS? 1:0;
onload=auPreload;

function auPreload() {
if (!ver4) return;
if (NS) auEmb = new Layer(0,window);
else {
Str = "<DIV ID='auEmb' STYLE='position:absolute;'></DIV>";
document.body.insertAdjacentHTML("BeforeEnd",Str);
}
var Str = '';
for (i=0;i<aySound.length;i++)
Str += "<EMBED SRC='"+aySound[i]+"' AUTOSTART='FALSE' HIDDEN='TRUE'>"
if (IE) auEmb.innerHTML = Str;
else {
auEmb.document.open();
auEmb.document.write(Str);
auEmb.document.close();
}
auCon = IE? document.all.auIEContainer:auEmb;
auCon.control = auCtrl;
}
function auCtrl(whSound,play) {
if (IE) this.src = play? aySound[whSound]:'';
else eval("this.document.embeds[whSound]." + (play? "play()":"stop()"))
}
function playSound(whSound) { if (window.auCon) auCon.control(whSound,true); }
function stopSound(whSound) { if (window.auCon) auCon.control(whSound,false); }


/*****

Image Cross Fade Redux
Version 1.0
Last revision: 02.15.2006
steve@slayeroffice.com

Please leave this notice intact. 

Rewrite of old code found here: http://slayeroffice.com/code/imageCrossFade/index.html


*****/


window.addEventListener?window.addEventListener("load",so_init,false):window.attachEvent("onload",so_init);

var d=document, imgs = new Array(), img_div_content = new Array(),  current=0;

function so_init() {
	if(!d.getElementById || !d.createElement) {
		return;
	}
	
	img_div_content[0] = new Array();
	img_div_content[1] = new Array();
	img_div_content[2] = new Array();
	img_div_content[3] = new Array();
	img_div_content[4] = new Array();
	
	img_div_content[0][0] = "235px";  //bottom
	img_div_content[0][1] = "592px";  //left
	
	img_div_content[1][0] = "65px";   //bottom
	img_div_content[1][1] = "620px";  //left
	
	img_div_content[2][0] = "182px";   //bottom
	img_div_content[2][1] = "318px";  //left
	
	img_div_content[3][0] = "207px";   //bottom
	img_div_content[3][1] = "841px";  //left
	
	img_div_content[4][0] = "212px";   //bottom
	img_div_content[4][1] = "814px";  //left
	
	
	imgs = d.getElementById("imageContainer").getElementsByTagName("img");
	
	for(i=1; i<imgs.length; i++) imgs[i].xOpacity = 0;
	imgs[0].style.display = "block";
	imgs[0].xOpacity = .99;
	
	setTimeout(so_xfade,5000);
}

function so_xfade() {
	
	bird_div = d.getElementById("bird");
	bird_div_moved = false;

	cOpacity = imgs[current].xOpacity;
	nIndex = imgs[current+1]?current+1:0;

	nOpacity = imgs[nIndex].xOpacity;
	
	cOpacity-=.05; 
	nOpacity+=.05;
	
	imgs[nIndex].style.display = "block";
	imgs[current].xOpacity = cOpacity;
	imgs[nIndex].xOpacity = nOpacity;
	
	setOpacity(imgs[current]); 
	setOpacity(imgs[nIndex]);
	
	if((cOpacity < .45) && (!bird_div_moved)) {
		//Move the bird divs position
		bird_div.style.bottom = img_div_content[nIndex][0];
		bird_div.style.left = img_div_content[nIndex][1];
		bird_div_moved = true;
	}
	
	if(cOpacity<=0) {
		imgs[current].style.display = "none";
		current = nIndex;
		bird_div_moved = false;
		setTimeout(so_xfade,5000);
	} else {
		setTimeout(so_xfade,100);
	}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
	
}