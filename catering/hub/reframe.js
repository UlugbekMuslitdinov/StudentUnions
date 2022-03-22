//https://stackoverflow.com/a/326076
function inIframe () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}

window.onload = function(){
	if(!inIframe()){
		document.body.style.margin = "0.5%";
		document.body.style.padding = "1%";
		document.body.style.height = "initial";
		document.body.style.width = "initial";
	}
}