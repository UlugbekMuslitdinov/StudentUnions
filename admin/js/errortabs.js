//Show error text on hover where applicable
//All you have to do is include this file, and
//give class "tbl-edit-error" and set attribute
//"data-error" as the error text on elements
//you want to have an error.
//Updating "data-error" will change the text, but
//you can't add it to an element that didn't have
//it at page load.
document.addEventListener("DOMContentLoaded", function (){
	var errorTab = document.createElement("div");
	document.body.appendChild(errorTab);
	errorTab.style.position = "absolute";
	errorTab.style.display = "none";
	errorTab.style.border = "1px solid red";
	errorTab.style.borderBottom = "none";
	errorTab.style.borderTopRightRadius = "3px";
	errorTab.style.borderTopLeftRadius = "3px";
	errorTab.style.background = "#f33";
	errorTab.style.color = "#000";
	errorTab.style.fontFamily = "sans-serif";
	errorTab.style.fontSize = "13px";
	errorTab.style.fontWeight = "bold";
	errorTab.style.padding = "0px 4px";
	errorTab.style.zIndex = "100";
	
	var errorFields = document.querySelectorAll(".tbl-edit-error");
	for (var field = 0; field < errorFields.length; field++) {
		var errorField = errorFields[field];
		if (typeof errorField.getAttribute("data-error") === "string") {
			errorField.addEventListener("mouseenter", pinError);
			errorField.addEventListener("mouseout", hideError);
		}
	}
	
	function pinError(e){
		var elem = e.currentTarget;
		errorTab.innerHTML = elem.getAttribute("data-error");
		errorTab.currentTarget = elem;
		errorTab.style.display = "block";
		var iBB = elem.getBoundingClientRect();
		var eBB = errorTab.getBoundingClientRect();
		errorTab.style.left = iBB.left + document.body.scrollLeft + "px";
		errorTab.style.top = iBB.top-eBB.height+document.body.scrollTop+"px";
		if (eBB.width > iBB.width) {
			errorTab.style.borderBottomRightRadius="3px";
		} else {
			errorTab.style.borderBottomRightRadius="0px";
		}
	}
	
	function hideError(e){
		var bb = e.currentTarget.getBoundingClientRect();
		if (
				   e.clientX < bb.left
				|| e.clientX > bb.right
				|| e.clientY < bb.top
				|| e.clientY > bb.bottom
			) {
			errorTab.style.display = "none";
		}
	}
});