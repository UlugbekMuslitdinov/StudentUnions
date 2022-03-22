	//-----------------------------------------------------*
	// this function automatically moves the cursor to the
	// next field when the maximum number of characters has
	// been reached.
	//-----------------------------------------------------*
	function moveOnMax(field,nextFieldID){
  		if(field.value.length >= field.maxLength) {
   			 document.getElementById(nextFieldID).focus();
  	    }
	}
	
	$(function() {
		// --- Using the default options:
		$("h2.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "h2.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 