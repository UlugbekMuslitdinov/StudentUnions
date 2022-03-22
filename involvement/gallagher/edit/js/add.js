$('body').on('focus',".datepicker", function(){
    $(this).datepicker({
		"showAnim":"drop",
		"dateFormat":"mm/dd/yy",
		showButtonPanel: true
	});
});

$('body').on('focus',".timepicker", function(){
    $(this).timepicker({ 
    	'timeFormat': 'h:i A',
    	'scrollDefault': '12:00 AM',
    	'autoclose': true
    });
    $(this).on('selectTime', function() {
	    $(this).timepicker('hide');	
	});
});

$('.timepicker').timepicker({defaultTime: 'value'});


function addMoreNames(index){
	var numName = document.getElementById('nameCount'+index).value;
	var nextIndex = parseInt(numName) + 1;

	// Update new count
	document.getElementById('nameCount'+index).value = nextIndex;

	var newInput = document.createElement('div');
	newInput.className = 'input-group';
	newInput.id = 'movie_names'+index+'_'+nextIndex;
	newInput.innerHTML = printMovieNameInput(index,nextIndex);

	document.getElementById('movie_names'+index).appendChild(newInput);
}

function printMovieNameInput(boxIndex,nameIndex){
	var id = "\'movie_names" + boxIndex + "_" + nameIndex + "\'";
	var print = '<span class="input-group-addon"><span class="glyphicon glyphicon-film" aria-hidden="true"></span></span>'+
                '<input type="text" class="form-control" id="name'+boxIndex+'_'+nameIndex+'" name="name'+boxIndex+'_'+nameIndex+'" aria-describedby="name'+boxIndex+'_'+nameIndex+'" required>'+
                '<span class="input-group-addon" onclick="deleteMovieName('+boxIndex + ',' + id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>';

	return print;
}

function addMoreTime(index){
	var numName = document.getElementById('timeCount'+index).value;
	var nextIndex = parseInt(numName) + 1;

	// Update new count
	document.getElementById('timeCount'+index).value = nextIndex;

	var newInput = document.createElement('div');
	newInput.className = 'input-group';
	newInput.id = 'movie_time'+index+'_'+nextIndex;
	newInput.innerHTML = printMovieTimeInput(index,nextIndex);

	document.getElementById('movie_time'+index).appendChild(newInput);
}

function printMovieTimeInput(boxIndex,nameIndex){
	var id = "\'movie_time" + boxIndex + "_" + nameIndex + "\'";
	var print = '<span class="input-group-addon"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></span>'+
                '<input type="text" class="form-control timepicker" id="time'+boxIndex+'_'+nameIndex+'" name="time'+boxIndex+'_'+nameIndex+'" value="12:00 AM" aria-describedby="time'+boxIndex+'_'+nameIndex+'" pattern="(0?[1-9]|1[012])(:[0-5]\\d) [APap][mM]" required>'+
                '<span class="input-group-addon" onclick="deleteMovieTime('+boxIndex + ',' + id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>';

	return print;
}

function addMoreMovie(){
	var numBox = document.getElementById('addBoxCount').value;
	var nextIndex = parseInt(numBox) + 1;

	// Update new count
	document.getElementById('addBoxCount').value = nextIndex;

	var print = printAddBox(nextIndex);
	var newBox = document.createElement("div");
	newBox.innerHTML = print;
	newBox.className = 'add-box';
	newBox.id = 'box' + nextIndex;
	document.getElementById('addBoxes').appendChild(newBox);
}

function printAddBox(index){
	var id = "\'box" + index + "\'";
	var print = '<div class="add-box-control"><span class="remove-box close" onclick="deleteBox('+id+');">x</span></div>'+
            	'<div class="wrap-add-inputs">'+
					'<div class="col-sm-6"><span><label>Start Date</label></span><div class="input-group">'+
		              '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>'+
		              '<input type="text" class="form-control datepicker" id="date'+index+'" name="date'+index+'" aria-describedby="date'+index+'" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\\d\\d" required>'+
		            '</div>'+
					'<span><label>End Date</label></span><div class="input-group">'+
		              '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>'+
		              '<input type="text" class="form-control datepicker" id="end_date'+index+'" name="end_date'+index+'" aria-describedby="end_date'+index+'" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\\d\\d" required>'+
		            '</div></div>'+
		            '<div class="col-sm-6"><span><label>Movie Time</label></span><div class="movie-time'+index+'" id="movie_time'+index+'">'+
		                '<input type="hidden" name="timeCount'+index+'" id="timeCount'+index+'" value="1">'+
		                '<div class="input-group" id="movie_time'+index+'_1">'+
		                  	'<span class="input-group-addon" id="time'+index+'"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></span>'+
		                  	'<input type="text" class="form-control timepicker" id="time'+index+'" name="time'+index+'" value="12:00 AM" aria-describedby="name'+index+'" pattern="(0?[1-9]|1[012])(:[0-5]\\d) [APap][mM]" required>'+
		                  	'<span class="input-group-addon" onclick="deleteMovieTime('+index+',\'movie_time'+index+'_1\');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>'+
		                '</div>'+
		              	'</div>'+
		            '<button type="button" class="btn btn-default more-time-btn col-sm-12" onclick="addMoreTime('+index+');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>'+
		        	'</div>'+
		            '<div class="col-sm-12"><span><label>Movie Title</label></span><div class="movie-names'+index+'" id="movie_names'+index+'">'+
		              '<input type="hidden" name="nameCount'+index+'" id="nameCount'+index+'" value="1">'+
		              '<div class="input-group" id="movie_names'+index+'_1">'+
		              	'<span class="input-group-addon" id="name'+index+'"><span class="glyphicon glyphicon-film" aria-hidden="true"></span></span>'+
		              	'<input type="text" class="form-control" id="name'+index+'" name="name'+index+'" aria-describedby="name'+index+'" required>'+
		              	'<span class="input-group-addon" onclick="deleteMovieName('+index+',\'movie_names'+index+'_1\');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>'+
		              '</div>'+
		            '</div>'+
		            '<button type="button" class="btn btn-default more-names-btn col-sm-12" onclick="addMoreNames('+index+');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>'+
		            '</div>'+
		        '</div>';
	return print;
}

function deleteBox(id){
	var numBox = document.getElementById('addBoxCount').value;

	if (numBox > 1){
		$('#'+id).remove();
		// document.getElementById(id).remove();
		// Decrement count
		document.getElementById('addBoxCount').value = parseInt(numBox) - 1;
	}
}

function deleteMovieName(boxIndex,id){
	var numBox = document.getElementById('nameCount'+boxIndex).value;

	if (numBox > 1){
		$('#'+id).remove();
		// Decrement count
		document.getElementById('nameCount'+boxIndex).value = parseInt(numBox) - 1;
	}
}

function deleteMovieTime(boxIndex,id){
	var numBox = document.getElementById('timeCount'+boxIndex).value;

	if (numBox > 1){
		$('#'+id).remove();
		// Decrement count
		document.getElementById('timeCount'+boxIndex).value = parseInt(numBox) - 1;
	}
}