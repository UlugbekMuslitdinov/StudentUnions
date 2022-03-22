//Enables moving items between two select lists and formatting for form submit
//baseElem is an HTML element containing the elements listed below
function optArray(baseElem){
	
	//Autoinstantiation
	if(!(this instanceof optArray)){
		return new optArray(baseElem);
	}
	
	//Returns array of option elements that were selected
	//selElem is a select element
	function getSelected(selElem){
		selected = [];
		for (var opt = 0; opt<selElem.options.length; opt++) {
			if(selElem.options[opt].selected){
				selected.push(selElem.options[opt]);
			}
		}
		return selected;
	}
	
	//Returns array of all child option elements
	//selElem is a select element
	function getAllOpts(selElem){
		options = [];
		for (var opt = 0; opt<selElem.options.length; opt++) {
			options.push(selElem.options[opt]);
		}
		return options;
	}
	
	//Moves options to another select
	//options is an array of option elements, selElem is a select element
	function moveOpts(options, selElem){
		for (var opt in options) {
			selElem.appendChild(options[opt]);
		}
	}
	
	//Sort child elements by value
	function sortOpts(selElem){
		var options = [];
		for (var opt = 0; opt<selElem.childNodes.length; opt++) {
			options[parseInt(selElem.childNodes[opt].value)] = selElem.childNodes[opt];
		}
		for (var opt in options) {
			selElem.appendChild(options[opt]);
		}
	}
	
	//Get multiselect lists
	var selectOptions = baseElem.querySelector(".tbl-optarray-options");
	var selectedOptions = baseElem.querySelector(".tbl-optarray-selected");
	
	//Select all options in selectedOptions so the form can properly submit
	this.selectAll = function(){
		for (var opt = 0; opt<selectedOptions.options.length; opt++) {
			selectedOptions.options[opt].selected = true;
		}
	};
	
	//Get starting state
	var selected = getAllOpts(selectedOptions);
	var unselected = getAllOpts(selectOptions);
	
	//Revert to only originally selected options
	this.revert = function(){
		moveOpts(selected, selectedOptions);
		moveOpts(unselected, selectOptions);
		sortOpts(selectedOptions);
		sortOpts(selectOptions);
	}
	
	//Add a new option (starts unselected)
	this.addOption = function(index, label){
		var newOpt = document.createElement("option");
		newOpt.value = index;
		newOpt.innerHTML = label;
		selectOptions.appendChild(newOpt);
		unselected.push(newOpt);
		selectedOptions.size++;
		selectOptions.size++;
	};
	
	//Removes an option
	this.removeOption = function(index){
		for (var opt = 0; opt<selectOptions.options.length; opt++) {
			if (selectOptions.options[opt].value == index) {
				selectOptions.removeChild(selectOptions.options[opt]);
				selectedOptions.size--;
				selectOptions.size--;
			}
		}
		var save = false;
		for (var opt = 0; opt<selectedOptions.options.length; opt++) {
			if (selectedOptions.options[opt].value == index) {
				selectedOptions.removeChild(selectedOptions.options[opt]);
				selectedOptions.size--;
				selectOptions.size--;
				save = true;
			}
		}
		if (save) { //Save form if we removed selected options
			document.getElementById("edit-save").click();
		}
	};
	
	//If this is disabled, don't set up controls
	if (baseElem.querySelector(".act-locked") !== null) return;
	
	//Get controls
	var leftAllButton = baseElem.querySelector(".act-left-all");
	var leftButton = baseElem.querySelector(".act-left");
	var rightButton = baseElem.querySelector(".act-right");
	var rightAllButton = baseElem.querySelector(".act-right-all");
	
	leftAllButton.onclick = function(){ //Deselect all options
		moveOpts(getAllOpts(selectOptions), selectedOptions);
		sortOpts(selectedOptions);
	};
	
	leftButton.onclick = function(){ //Deselect highlighted options
		moveOpts(getSelected(selectOptions), selectedOptions);
		sortOpts(selectedOptions);
	};
	
	rightButton.onclick = function(){ //Select highlighted options
		moveOpts(getSelected(selectedOptions), selectOptions);
		sortOpts(selectOptions);
	};
	
	rightAllButton.onclick = function(){ //Select all options
		moveOpts(getAllOpts(selectedOptions), selectOptions);
		sortOpts(selectOptions);
	};
	
	//Get everything sorted
	sortOpts(selectOptions);
	sortOpts(selectedOptions);
}

var OC_STATE_INACTIVE = 0;
var OC_STATE_INPUT = 1;
var OC_STATE_SERVER = 2;

//Enables adding options to option and option-array fields
//Requires serverside script "option_create.php" in same directory as main page
//baseElem is an HTML element containing the elements listed below
function optCreate(baseElem){
	
	//Autoinstantiation
	if(!(this instanceof optCreate)){
		return new optCreate(baseElem);
	}
	
	this.state = OC_STATE_INACTIVE; //The current state
	this.callback = function(){}; //Function to run after successfully adding an option with parameters (index, label)
	var self = this;
	
	//If this is disabled, don't set up controls
	if (baseElem.querySelector(".act-locked") !== null) return;
	
	//Get all needed elements
	var optButton = baseElem.querySelector(".teo-create");
	var optButtonMutex = baseElem.querySelector(".teo-delete");
	var optBox = baseElem.querySelector(".tbl-option-create");
	var optBoxSelect = baseElem.querySelector(".tbl-option-select");
	if (optBoxSelect.name == "") {
		var interBox = baseElem.querySelector(".tbl-optarray-selected");
		var field = interBox.name.replace(/\[\]/g, '');
	} else {
		var field = optBoxSelect.name;
	}
	
	function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
	}
	
	function optionCreateTxn(label){
		var txn = new XMLHttpRequest();
		
		txn.onreadystatechange = function(){
			if (txn.readyState == XMLHttpRequest.DONE && txn.status == 200) {
				result = JSON.parse(txn.responseText);
				if (typeof result.error === "undefined") {
					var newOpt = document.createElement("option");
					newOpt.value = result.index;
					newOpt.innerHTML = result.label;
					optBoxSelect.appendChild(newOpt);
					self.callback(result.index, result.label);
				}else{
					console.log(result.error);
				}
				resetOptCreate();
			} else if (txn.readyState == XMLHttpRequest.DONE && txn.status == 500) {
				console.log("server error");
				resetOptCreate();
			}
		}
		
		requestURI = "./option_create.php";
		requestData  = "form="+encodeURIComponent(getQueryVariable("form"));
		requestData += "&field="+encodeURIComponent(field);
		requestData += "&label="+encodeURIComponent(label);
		txn.open("POST", requestURI);
		txn.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		txn.send(requestData);
	}
	
	function resetOptCreate(){
		optButton.className = "tbl-extended-options teo-create";
		optButtonMutex.className = "tbl-extended-options teo-delete";
		optBox.className = "tbl-option-create";
		window.setTimeout(function(){
			optBox.value="";
			self.state = OC_STATE_INACTIVE;
		}, 250);
	}
	
	optButton.onclick = function(e){
		this.blur();
		if (self.state == OC_STATE_INACTIVE) {
			optButton.className = "tbl-extended-options teo-create revealed";
			optButtonMutex.className = "tbl-extended-options teo-delete concealed";
			optBox.className = "tbl-option-create revealed";
			optBox.focus();
			self.state = OC_STATE_INPUT;
		} else if (self.state == OC_STATE_INPUT) {
			if (optBox.value != "") {
				optButton.className = "tbl-extended-options teo-create concealed";
				self.state = OC_STATE_SERVER;
				optionCreateTxn(optBox.value);
			} else {
				resetOptCreate();
			}
		}
	}
	
	optBox.onkeypress = function(e){
		if (e.keyCode == 13) {
			e.preventDefault();
			optButton.click();
		}
	}
	
}

//Enables deleting options from option and option-array fields
//Requires serverside script "option_delete.php" in same directory as main page
//baseElem is an HTML element containing the elements listed below
function optDelete(baseElem){
	
	//Autoinstantiation
	if(!(this instanceof optDelete)){
		return new optDelete(baseElem);
	}
	
	this.state = OC_STATE_INACTIVE; //The current state
	this.callback = function(){}; //Function to run after successfully adding an option with parameter (index)
	var self = this;
	
	//If this is disabled, don't set up controls
	if (baseElem.querySelector(".act-locked") !== null) return;
	
	//Get all needed elements
	var optButton = baseElem.querySelector(".teo-delete");
	var optButtonMutex = baseElem.querySelector(".teo-create");
	var optBox = baseElem.querySelector(".tbl-option-select");
	if (optBox.name == "") {
		var interBox = baseElem.querySelector(".tbl-optarray-selected");
		var field = interBox.name.replace(/\[\]/g, '');
	} else {
		var field = optBox.name
	}
	var prevSelection = optBox.selectedIndex;
	var save = false;
	
	function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
	}
	
	function optionDeleteTxn(index){
		var txn = new XMLHttpRequest();
		
		txn.onreadystatechange = function(){
			if (txn.readyState == XMLHttpRequest.DONE && txn.status == 200) {
				result = JSON.parse(txn.responseText);
				if (typeof result.error === "undefined") {
					for (var opt = 0; opt<optBox.options.length; opt++) {
						if (optBox.options[opt].value == result.index) {
							optBox.removeChild(optBox.options[opt]);
						}
					}
					if (optBox.options[prevSelection].value == result.index) {
						prevSelection = 0;
						save = true;
					}
					self.callback(result.index);
				}else{
					console.log(result.error);
				}
				resetOptDelete();
			} else if (txn.readyState == XMLHttpRequest.DONE && txn.status == 500) {
				console.log("server error");
				resetOptDelete();
			}
		}
		
		requestURI = "./option_delete.php";
		requestData  = "form="+encodeURIComponent(getQueryVariable("form"));
		requestData += "&field="+encodeURIComponent(field);
		requestData += "&index="+encodeURIComponent(index);
		txn.open("POST", requestURI);
		txn.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		txn.send(requestData);
	}
	
	function resetOptDelete(){
		optButton.className = "tbl-extended-options teo-delete";
		optButtonMutex.className = "tbl-extended-options teo-create";
		optBox.className = "tbl-option-select";
		optBox.selectedIndex=prevSelection;
		self.state = OC_STATE_INACTIVE;
		if (save) { //Save form if we removed selected option
			document.getElementById("edit-save").click();
		}
	}
	
	optButton.onclick = function(e){
		this.blur();
		if (self.state == OC_STATE_INACTIVE) {
			optButton.className = "tbl-extended-options teo-delete revealed";
			optButtonMutex.className = "tbl-extended-options teo-create concealed";
			optBox.className = "tbl-option-select revealed";
			prevSelection = optBox.selectedIndex;
			optBox.value = "";
			optBox.focus();
			self.state = OC_STATE_INPUT;
		} else if (self.state == OC_STATE_INPUT) {
			if (optBox.value != "") {
				var alertText;
				alertText  = "Are you sure you want to delete the option: \n";
				alertText += optBox.options[optBox.selectedIndex].text + "?\n";
				alertText += "This will be removed from EVERY record and CANNOT be reversed!";
				if(window.confirm(alertText)){
					optButton.className = "tbl-extended-options teo-delete concealed";
					self.state = OC_STATE_SERVER;
					optionDeleteTxn(optBox.value);
				}
			} else {
				resetOptDelete();
			}
		}
	}
	
	optBox.onkeypress = function(e){
		if (e.keyCode == 13) {
			e.preventDefault();
			optButton.click();
		}
	}
	
}

//Set up all option-array fields
document.addEventListener("DOMContentLoaded", function(){
	var optarrayFNs = [];
	var optarrays = document.querySelectorAll(".tbl-optarray");
	for (var opt = 0; opt<optarrays.length; opt++) {
		optarrayFNs[opt] = new optArray(optarrays[opt]);
		var temp = new optCreate(optarrays[opt]);
		temp.callback = optarrayFNs[opt].addOption;
		temp = new optDelete(optarrays[opt]);
		temp.callback = optarrayFNs[opt].removeOption;
	}
	
	var optselects = document.querySelectorAll(".tbl-optselect");
	for (var opt = 0; opt<optselects.length; opt++) {
		optCreate(optselects[opt]);
		optDelete(optselects[opt]);
	}
	
	//Prep all option-array fields to be sumbitted
	document.getElementById("edit-save").addEventListener("click", function(){
		for (var i in optarrayFNs) {
			optarrayFNs[i].selectAll();
		}
	});
	
	//Reset all option-array fields to their default values
	document.getElementById("edit-reset").addEventListener("click", function(){
		for (var i in optarrayFNs) {
			optarrayFNs[i].revert();
		}
	});
});