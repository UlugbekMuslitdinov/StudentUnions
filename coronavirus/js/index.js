var loaded = false;
var days = ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
var months = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];

function display_data(){
	var date = new Date();
	var day = date.getDay();
	var month = date.getMonth();
	var _date = date.getDate();
	var year = date.getFullYear();

	//day = 0;

	fetch('/api/boxes/getlist/' + day)
	.then(function(response) {
	    return response.json();
	})
	.then(function(json) {
	    if (json.success){
	    	data = json.data;
	        loaded = true;
	        update(data, day, month, _date, year);
	    }
	    else{
	    	console.log("JSON error!");
	    }
	});
}

function update(data, day, month, _date, year){
	menu_date = document.getElementById("menu-date");
	menu_date.innerHTML = days[day] + ", " + months[month] + " " + _date + ", " + year + " MENUS";

	if(data.lunch_1 !== "" || data.lunch_2 !== "" || data.lunch_3 !== ""){
		//breakfast
		breakfast_beverage = document.getElementById("breakfast-beverage");
		li = document.createElement('li');
		li.innerHTML = data.breakfast_beverage;
		breakfast_beverage.appendChild(li);

		breakfast_box1 = document.getElementById("breakfast-box1");
		breakfast_items = [data.breakfast_1];
		items = breakfast_items.concat(data.breakfast_bag.split(", "));

		for(i=0; i<items.length; i++){
			if(items[i] === ""){
				continue;
			}
			li = document.createElement('li');
			li.innerHTML = items[i];
			breakfast_box1.appendChild(li);
		}

		//lunch
		lunch_beverage = document.getElementById("lunch-beverage");
		li = document.createElement('li');
		li.innerHTML = data.lunch_beverage;
		lunch_beverage.appendChild(li);

		for(i=1; i <= 3; i++){
			if(data["lunch_" + i] === ""){
				div = document.getElementById("lunch" + i);
				div.parentNode.removeChild(div);
				continue;
			}
	    	box = document.getElementById("lunch-box" + i);
	    	items = [data["lunch_" + i]];
	    	items = items.concat(data.lunch_bag.split(", "));

	    	for(j=0; j<items.length; j++){
	    		if(items[j] === ""){
	    			continue;
	    		}
	    		li = document.createElement('li');
	    		li.innerHTML = items[j];
	    		box.appendChild(li);
	    	}
		}

		//dinner
		dinner_beverage = document.getElementById("dinner-beverage");
		li = document.createElement('li');
		li.innerHTML = data.dinner_beverage;
		dinner_beverage.appendChild(li);

		for(i=1; i <= 3; i++){
			if(data["dinner_" + i] === ""){
				div = document.getElementById("dinner" + i);
				div.parentNode.removeChild(div);
				continue;
			}
	    	box = document.getElementById("dinner-box" + i);
	    	items = [data["dinner_" + i]];
	    	items = items.concat(data.dinner_bag.split(", "));

	    	for(j=0; j<items.length; j++){
	    		if(items[j] === ""){
	    			continue;
	    		}
	    		li = document.createElement('li');
	    		li.innerHTML = items[j];
	    		box.appendChild(li);
	    	}
		}
	}
	else{
		//brunch title
		title = document.getElementById("breakfast-title");
		title.innerHTML = "BRUNCH BOXES: ";

		//brunch
		breakfast_beverage = document.getElementById("breakfast-beverage");
		li = document.createElement('li');
		li.innerHTML = data.breakfast_beverage;
		breakfast_beverage.appendChild(li);

		breakfast_box1 = document.getElementById("breakfast-box1");
		breakfast_items = [data.breakfast_1];
		items = breakfast_items.concat(data.breakfast_bag.split(", "));

		for(i=0; i<items.length; i++){
			if(items[i] === ""){
				continue;
			}
			li = document.createElement('li');
			li.innerHTML = items[i];
			breakfast_box1.appendChild(li);
		}

		//lunch beverage
		for(i=1; i<=3; i++){
			div = document.getElementById("lunch" + i);
			div.parentNode.removeChild(div);
		}

		if(data.lunch_beverage !== ""){
			lunch_title = document.getElementById("lunch-title");
			lunch_title.innerHTML = "LUNCH: ";

			lunch_beverage = document.getElementById("lunch-beverage");
			li = document.createElement('li');
			li.innerHTML = data.lunch_beverage;
			lunch_beverage.appendChild(li);
		}
		else{
			lunch_div = document.getElementById("lunch-boxes");
			lunch_div.parentNode.removeChild(lunch_div);
		}

		//dinner
		dinner_beverage = document.getElementById("dinner-beverage");
		li = document.createElement('li');
		li.innerHTML = data.dinner_beverage;
		dinner_beverage.appendChild(li);

		for(i=1; i <= 3; i++){
			if(data["dinner_" + i] === ""){
				div = document.getElementById("dinner" + i);
				div.parentNode.removeChild(div);
				continue;
			}
	    	box = document.getElementById("dinner-box" + i);
	    	items = [data["dinner_" + i]];
	    	items = items.concat(data.dinner_bag.split(", "));

	    	for(j=0; j<items.length; j++){
	    		if(items[j] === ""){
	    			continue;
	    		}
	    		li = document.createElement('li');
	    		li.innerHTML = items[j];
	    		box.appendChild(li);
	    	}
		}	

	}
	menu_loading = document.getElementById("menu-loading");
	menu = document.getElementById("boxes-menu");

	menu_loading.parentNode.removeChild(menu_loading);
	menu.style = "";

	console.log(data);
}

display_data()