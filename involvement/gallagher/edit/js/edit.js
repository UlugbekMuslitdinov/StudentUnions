


function editRow(id){
	// Set id
	document.getElementById('id').value = id;

	// Set action
	document.getElementById('action').value = 'edit';

	// Reset div
	document.getElementById('movie_names1').innerHTML = "";
	document.getElementById('movie_time1').innerHTML = "";

	// Add count
	var inputCountName = document.createElement("input");
	inputCountName.setAttribute("type", "hidden");
	inputCountName.setAttribute("value", "0");
	inputCountName.name = "nameCount1";
	inputCountName.id = "nameCount1";

	var inputCountTime = document.createElement("input");
	inputCountTime.setAttribute("type", "hidden");
	inputCountTime.setAttribute("value", "0");
	inputCountTime.name = "timeCount1";
	inputCountTime.id = "timeCount1";

	document.getElementById('movie_names1').appendChild(inputCountName);
	document.getElementById('movie_time1').appendChild(inputCountTime);


	var parent = document.getElementById('row'+id);
	var date = parent.childNodes[0].innerHTML;
	var end_date = parent.childNodes[1].innerHTML;
	var time = parent.childNodes[2].innerHTML;
	var name = parent.childNodes[3].innerHTML;

	time = time.split('<br>');
	name = name.split('<br>');

	time = time.filter(Boolean);
	name = name.filter(Boolean);

	// Enter into inputs
	document.getElementById('date').value = date;
	document.getElementById('end_date').value = end_date;
	var index = 0;
	for (var i = 0; i < time.length; i++) {
		addMoreTime(1);
		index = (i+1).toString();
		document.getElementById('time1_'+index).value = time[i];
	}
	for (var i = 0; i < name.length; i++) {
		addMoreNames(1);
		index = (i+1).toString();
		document.getElementById('name1_'+index).value = name[i];
	}
}


function deleteRow(id){
	// Set id
	document.getElementById('id').value = id;

	// Set action
	document.getElementById('action').value = 'delete';

	// Submit form
	document.getElementById('editForm').submit();
}