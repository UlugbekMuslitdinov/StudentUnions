// Change color of btn on click
$('body').on('click','.food_choice',function(){
	var name = $(this).attr("name");
	if ($(this).is(':checked')){
		$(this).parent().addClass('btn-selected');
		addNumMeat(name);
		$(this).parent().parent().parent().find('.burr_err').text(' ');
	}else {
		$(this).parent().removeClass('btn-selected');
		removeNumMeat(name);
	}
});

function addNumMeat(name){
	var total = $("#total_price").val();
	total = parseFloat(total);
	name = name.replace(/[\[\]&]+/g," ");
	name = name.split(" ");
	var num_beef = 0;
	if (name[3] == "meat"){
		var index = name[1];
		if (name[0] == "pack12"){
			num_beef = price_pack12[index][name[2]] + 1;
			price_pack12[index][name[2]] = num_beef;
		}else if (name[0] == "pack8"){
			num_beef = price_pack8[index][name[2]] + 1;
			price_pack8[index][name[2]] = num_beef;
		}
	}else{
		return;
	}

	if (num_beef > 1){
		total = total + 2;
	}

	$("#total_price").val(total.toFixed(2));
	// console.log(total);
}

function removeNumMeat(name){
	var total = $("#total_price").val();
	total = parseFloat(total);
	name = name.replace(/[\[\]&]+/g," ");
	name = name.split(" ");
	var num_beef = 0;
	if (name[3] == "meat"){
		var index = name[1];
		if (name[0] == "pack12"){
			num_beef = price_pack12[index][name[2]] - 1;
			price_pack12[index][name[2]] = num_beef;
		}else if (name[0] == "pack8"){
			num_beef = price_pack8[index][name[2]] - 1;
			price_pack8[index][name[2]] = num_beef;
		}
	}else{
		return;
	}

	if (num_beef > 0){
		total = total - 2;
	}
	$("#total_price").val(total.toFixed(2));
	// console.log(total);
}

// Duplicate Burrito
$('body').on('click','.duplicate',function(){
	var parent = $(this).parent().parent();
	var panel_body = parent.parent();
	var parent_index = parent.index();
	var pre_index = parent_index - 1;

	// duplicated choice from burrito right above
	var pre_burrito = panel_body.children().eq(pre_index);
	var choice_length = pre_burrito.find('input').length;
	var bool_checked = false;
	for (var i = 0; i < choice_length; i++) {
		bool_checked = pre_burrito.find('input').eq(i).is(':checked');
		if (bool_checked){
			if (!parent.find('input').eq(i).is(':checked')){
				parent.find('input').eq(i).click();
			}
		}else{
			if (parent.find('input').eq(i).is(':checked') ){
				parent.find('input').eq(i).click();
			}
		}
	}

	// Remove error msg
	if (parent.find('input:checked').length != 0){
		$(this).parent().parent().find('.burr_err').text('');
	}
});




/*
		Pack Quantity
*/
$('#pack12_quantity, #pack8_quantity').on({
	keyup:function(){
		$('#quantity_err').text(''); // Remove err msg
		onChangePackQuantity($(this).attr('id'));
	},
	change:function(){
		$('#quantity_err').text('');
		onChangePackQuantity($(this).attr('id'));
	}
});

$('.btn-qtn-plus').on({
	click:function(){
		var current_qtn = $(this).parent().parent().find('input').val();
		$(this).parent().parent().find('input').val(parseInt(current_qtn) + 1);
		onChangePackQuantity($(this).parent().parent().find('input').attr('id'));
	}
});

$('.btn-qtn-minus').on({
	click:function(){
		var current_qtn = $(this).parent().parent().find('input').val();
		if (current_qtn != 0){
			current_qtn = parseInt(current_qtn) - 1;
		}
		$(this).parent().parent().find('input').val(current_qtn);
		onChangePackQuantity($(this).parent().parent().find('input').attr('id'));
		$(this).parent().parent().find('input').focusin();
	}
});



/*
	print burrito selection menu
*/
var pack12 = 0;
var pack8 = 0;
function onChangePackQuantity(id){
	// Set which pack and number of packs
	if (id == 'pack12_quantity'){
		packNum = 12;
		quantity = $('#'+id).val();
		$("#pack12_qtn_display").text(quantity);
	}else{
		packNum = 8;
		quantity = $('#'+id).val();
	}
	var diff = 0;
	var packId = 0;
	if (packNum == 12){
		diff = quantity - pack12;
		packId = pack12;
		addremovePack(packNum,diff,packId)
		pack12 = quantity;
	}else if (packNum == 8){
		diff = quantity - pack8;
		packId = pack8;
		addremovePack(packNum,diff,packId)
		pack8 = quantity;
	}

	// Check if both are not selected
	if (pack12 == 0 && pack8 == 0){
		$("#quantity_err").text("At least choose one pack!");
	}else {
		$("#quantity_err").text("");
	}

}

function addremovePack(packNum,diff,packId){
	if (diff > 0){
		for (var i = 0; i < diff; i++) {
			// Add Pack
			packId++;
			$('#wrap_selection'+packNum).append(printPack(packNum,packId));
			updateTotalOnPackAdd(packNum);
		}	
		// updateTotalOnQtnChange(packNum,"add",diff);
	}else if (diff < 0){
		// Remove Pack
		for (var i = 0; i < Math.abs(diff); i++) {
			// $('#wrap_selection'+packNum+' #wrap_pack'+packNum+':last').remove();
			$('#wrap_pack_'+packNum+'_'+packId).remove();
			updateTotalOnPackRemove(packNum,packId);
			packId--;
		}
	}
}

var price_pack12 = [0];
var price_pack8 = [0];

function updateTotalOnPackAdd(packNum){
	var total = $("#total_price").val();
	total = parseFloat(total);
	if (packNum == 12){
		price_pack12.push([0,0,0,0,0,0,0,0,0,0,0,0,0]);
		total = total + 120;
		normal_price += 120;
	}else {
		price_pack8.push([0,0,0,0,0,0,0,0,0]);
		total = total + 89;
		normal_price += 89;
	}
	// console.log(price_pack12);
	$("#total_price").val(total.toFixed(2));
}

function updateTotalOnPackRemove(packNum,packId){
	var total = $("#total_price").val();
	total = parseFloat(total);
	var numBeef = 0;
	if (packNum == 12){
		// numBeef = price_pack12[packId] - 1; 
		// Check burrito has more than 2 meat 
		var temp_burr;
		for (var i = 1; i < price_pack12[packId].length; i++) {
			temp_burr = price_pack12[packId][i];
			if (temp_burr > 1){
				total = total - 2*(temp_burr-1);
			}
		}
		price_pack12.pop();
		total = total - 120;
		normal_price -= 120;
	}else if (packNum == 8) {
		// numBeef = price_pack8[packId] - 1; 
		// Check burrito has more than 2 meat 
		var temp_burr;
		for (var i = 1; i < price_pack8[packId].length; i++) {
			temp_burr = price_pack8[packId][i];
			if (temp_burr > 1){
				total = total - 2*(temp_burr-1);
			}
		}
		price_pack8.pop();
		total = total - 89;
		normal_price -= 89;
	}else {
		return;
	}

	$("#total_price").val(total.toFixed(2));
}


function printPack(packNum,packId){
	var print = '<div class="panel panel-primary wrap_pack" id="wrap_pack_'+packNum+'_'+packId+'">'+
	'<div class="panel-heading" role="tab" id="headingOne">'+
		'<div class="pack'+packNum+'">'+packNum+'-Pack - #'+ packId +'</div>'+
	'</div>';

	print += '<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">'+
	'<div class="panel-body">';
	for (var i = 0; i < packNum; i++) {
		print += printBurrito(packNum,packId,i+1);
	}
	print += '</div></div>';

	print += '</div>';
	return print;
}

var meat = ['Bacon','Sausage','Ham','Chorizo'];
var vegi = ['Mushroom', 'Onion','Bell Pepper', 'Spinach'];
function printBurrito(packNum,packId,burr_num){
	var print = '<div class="col-sm-12 remove-padding burrito_wrap no-highlight">';
	print += '<h5 class="burrito_num col-sm-1 remove-padding"><img class="burr_icon" src="img/burr_icon.png"> #'+burr_num+'</h5>'+
             printMeat(packNum,packId,burr_num)+
             printVegi(packNum,packId,burr_num);

    if (burr_num != 1){
    	print += '<div class="col-sm-1">'+
	             '<div class="btn btn-default duplicate">Duplicate</div>'+
	             '</div>';
    }
    print += '<div class="col-sm-10 burr_err text-danger"></div>';
    print += '</div>';

	return print;
}

function printMeat(packNum,packId,burr_num){
	var print = '<div class="col-sm-4 meat">';
	for (var i = 0; i < meat.length; i++) {
		print += '<label class="btn btn-default food_choice_label meat">'+
	             '<input type="checkbox" id="" class="food_choice" name="pack'+packNum+'['+packId+']['+burr_num+'][meat]['+i+']" value="'+meat[i]+'"> ' + meat[i]+
	             '</label>';
	}
	print += '</div>';
	return print;
}

function printVegi(packNum,packId,burr_num){
	var print = '<div class="col-sm-5 vegi">';
	for (var i = 0; i < vegi.length; i++) {
		print += '<label class="btn btn-default food_choice_label vegi">'+
	             '<input type="checkbox" id="" class="food_choice" name="pack'+packNum+'['+packId+']['+burr_num+'][vegi]['+i+']" value="'+vegi[i]+'"> ' + vegi[i]+
	             '</label>';
	}
	print += '</div>';
	return print;
}
/*
	end : print burrito selection menu
*/

/*
 *
 *  Update total on extra and upgrade change
 *
*/
var normal_price = 0;
var party_upgrade_price = 0;
var extra_qtn = [0,0,0,0];
var extra_price = [3.00, 3.00, 3.00, 3.00, 6.00];

var party_pack_upgrade = 0; // # of upgrade
var upgrade_selected = 0; // count how many sodas are selected
var soda_selected = { 
			upgrade_coke:0 , 
			upgrade_diet_coke:0 ,
			upgrade_sprite:0 , 
			upgrade_fanta:0 ,
			upgrade_water:0 
		};
// $('#extra_salsa').bind("keyup mouseup change focusout", function(){
// 	updateTotalOnExtraChange(0,$(this).val());
// });

// Extra qtn control
$('.btn-extra-qtn-plus, .btn-extra-qtn-minus').on({
	click:function(){
		selected_id = $(this).parent().parent().find('input').attr('id');
		var input = $(this).parent().parent().find('input');
		var current_qtn = input.val();
		if ($(this).hasClass("btn-extra-qtn-plus")){
			input.val(parseInt(current_qtn) + 1);
		}else if ($(this).hasClass("btn-extra-qtn-minus")){
			if (current_qtn > 0){
				input.val(parseInt(current_qtn) - 1);
			}
		}
		var newVal = parseInt(input.val());
		if(newVal < 0) {
			return;
		}
		switch(selected_id) {
		    case "extra_salsa":
		   		updateTotalOnExtraChange(0,newVal );
		   		// console.log(extra_qtn);
		        break;
		    case "extra_sourcream":
		        updateTotalOnExtraChange(1,newVal );
		        // console.log(extra_qtn);
		        break;
		    case "extra_guacamole":
		        updateTotalOnExtraChange(2,newVal);
		        // console.log(extra_qtn);
		        break;
		    case "extra_chips":
		        updateTotalOnExtraChange(3,newVal);
		        // console.log(extra_qtn);
		        break;
		    case "party_pack_upgrade":
		        updateTotalOnExtraChange(4,newVal);
		        partyPackUpgrade(newVal*2);
		        // console.log(extra_qtn);
		        break;
		    case "upgrade_coke":
		        checkPartyPackUpgrade("upgrade_coke");
		        // console.log(current_qtn);
		        break;
		    case "upgrade_diet_coke":
		        checkPartyPackUpgrade("upgrade_diet_coke");
		        // console.log(current_qtn);
		        break;
		    case "upgrade_sprite":
		        checkPartyPackUpgrade("upgrade_sprite");
		        // console.log(current_qtn);
		        break;
		    case "upgrade_fanta":
		        checkPartyPackUpgrade("upgrade_fanta");
		        // console.log(current_qtn);
		        break;
		    case "upgrade_water":
		        checkPartyPackUpgrade("upgrade_water");
		        // console.log(current_qtn);
		        break;
		    case "upgrade_coke_zero":
		        checkPartyPackUpgrade("upgrade_coke_zero");
		        break;
		    case "upgrade_dr_pepper":
		        checkPartyPackUpgrade("upgrade_dr_pepper");
		        break;
			case "upgrade_diet_dr_pepper":
		        checkPartyPackUpgrade("upgrade_diet_dr_pepper");
		        break;
		}
	}
});

$('#extra_salsa').bind("change", function(){
	if($(this).val() >= 0) {
		updateTotalOnExtraChange(0,$(this).val());
	}
});

$('#extra_sourcream').bind("change", function(){
	if($(this).val() >= 0) {
		updateTotalOnExtraChange(1,$(this).val());
	}
});

$('#extra_guacamole').bind("change", function(){
	if($(this).val() >= 0) {
		updateTotalOnExtraChange(2,$(this).val());
	}
});

$('#extra_chips').bind("change", function(){
	if($(this).val() >= 0) {
		updateTotalOnExtraChange(3,$(this).val());
	}
});

$('#party_pack_upgrade').bind("change", function(){
	if($(this).val() >= 0) {
		updateTotalOnExtraChange(4,$(this).val());
	}
});

// New radio button code TODO
$('input[type=radio][name=party_upgrade]').change(function() {
	if(this.value == 'eight_sodas') {
		console.log("eight");
		//party_pack_upgrade = 8;
		partyPackUpgrade(8);

		party_upgrade_price = 12;

		var total = normal_price + party_upgrade_price;
		$("#total_price").val(total.toFixed(2));
	}
	else if(this.value == 'twelve_sodas') {
		console.log("twelve");
		//party_pack_upgrade = 12;
		partyPackUpgrade(12);


		party_upgrade_price = 18;

		var total = normal_price + party_upgrade_price;
		$("#total_price").val(total.toFixed(2));
	}
	else if(this.value == 'no_sodas') {
		console.log("none");
		//party_pack_upgrade = 0;
		partyPackUpgrade(0);

		party_upgrade_price = 0;

		var total = normal_price + party_upgrade_price;
		$("#total_price").val(total.toFixed(2));
	}
});
//


function updateTotalOnExtraChange(id,newQtn){
	var total = $("#total_price").val();
	total = parseFloat(total);
	var diff = newQtn - extra_qtn[id];

	// Checks if there is a value in the input number box 
	if(!isNaN(diff)) {
		if (diff > 0){
			extra_qtn[id] = newQtn;
			total = total + diff*extra_price[id];
			normal_price += diff*extra_price[id];
		}else {
			extra_qtn[id] = newQtn;
			total = total + diff*extra_price[id];
			normal_price += diff*extra_price[id];
		}
	}
	// console.log(newQtn);
	// console.log(upgrade_selected);

	$("#total_price").val(total.toFixed(2));
}

// $('#total_price').bind("change", function(){
// 	console.log("changed");
// });

// Controll party pack upgrade

$("#party_pack_upgrade").bind("keyup mouseup change focusout", function(){
	var new_val = $(this).val();
	// Only process non-negative values
	if(parseInt(new_val) >= 0) {
		partyPackUpgrade(new_val*2);
	}
	// if (new_val < party_pack_upgrade){
	// 	// party pack upgrade qtn is smaller, then reset soda to 0
	// 	$("#upgrade_coke").val(0);
	// 	$("#upgrade_diet_coke").val(0);
	// 	$("#upgrade_sprite").val(0);
	// }else {
	// 	party_pack_upgrade = new_val;
	// }
});
function partyPackUpgrade(new_val){
	if (new_val < party_pack_upgrade){
		// party pack upgrade qtn is smaller, then reset all to 0
		$("#upgrade_coke").val(0);
		$("#upgrade_diet_coke").val(0);
		$("#upgrade_sprite").val(0);
		$("#upgrade_fanta").val(0);
		$("#upgrade_water").val(0);
		soda_selected['upgrade_coke'] = 0;
		soda_selected['upgrade_diet_coke'] = 0;
		soda_selected['upgrade_sprite'] = 0;
		soda_selected['upgrade_fanta'] = 0;
		soda_selected['upgrade_water'] = 0;
		upgrade_selected = 0;
	}

	party_pack_upgrade = new_val;
}

$("#upgrade_coke").bind("keyup mouseup change focusout", function(){
	checkPartyPackUpgrade($(this).attr("id"));
});

$("#upgrade_diet_coke").bind("keyup mouseup change focusout", function(){
	checkPartyPackUpgrade($(this).attr("id"));
});

$("#upgrade_sprite").bind("keyup mouseup change focusout", function(){
	checkPartyPackUpgrade($(this).attr("id"));
});

$("#upgrade_fanta").bind("keyup mouseup change focusout", function(){
	checkPartyPackUpgrade($(this).attr("id"));
});

$("#upgrade_water").bind("keyup mouseup change focusout", function(){
	checkPartyPackUpgrade($(this).attr("id"));
});

function checkPartyPackUpgrade(id){
	$("#partyPack_upgrade_err").text(" ");
	var diff = 0;
	var div = $("#"+id);
	diff = div.val() - soda_selected[id];
    soda_selected[id] = soda_selected[id] + checkPartyPackUpgradeSum(diff);
    div.val(soda_selected[id]);
}

function checkPartyPackUpgradeSum(diff){
	var temp_upgrade_selected = upgrade_selected + diff;
	if(isNaN(party_pack_upgrade)) {
		party_pack_upgrade = 0;
	}

	if (temp_upgrade_selected > party_pack_upgrade){
		return 0;
	}else {
		upgrade_selected = temp_upgrade_selected;
		return diff;
	}
}


/*
 *
 *  Float Total Price
 *
*/

$(window).scroll(function (event) {
    var scroll = $(window).scrollTop() + $(window).height();
    var pos_div_before_total = $("#before_total_price").position().top + 100;
    $(".total-price").addClass("fix_bottom");
    if (scroll > pos_div_before_total){
    	// place back to where it belongs
    	$(".total-price").removeClass("fix_total");
    }else {
    	// float
    	$(".total-price").addClass("fix_total");
    }

});


/*
 *
 *	SUBMIT FORM
 *
*/
var error_pos = "none";
$('body').on('click','#reviewOrder',function(){
	error_pos = "none";
	// Check if pack num is 0
	var error = false;
	if ($('#pack12_quantity').val()==0 && $('#pack8_quantity').val()==0){
		error = true;
		getErrPosition("#quantity_err");
		$('#quantity_err').text('At least choose one pack!');
	}

	// Check if there is any empty burrito 
	var all_burrito = $('#wrap_menu_selection .burrito_wrap');
	$(all_burrito).each(function(){
		var burr_checked = $(this).find('input:checked').length; 
		if (burr_checked == 0){
			$(this).find('.burr_err').text('At least select 1');
			// getErrPosition(".burr_err");
			//console.log($(this).parent().parent().parent().attr("id"));
			getErrPosition("#"+$(this).parent().parent().parent().parent().attr("id"));
			error = true;
		}
	});

	// var pack_upgrade_selected = coke_selected + diet_coke_selected + sprite_coke_selected;
	// Better use loop
	var pack_upgrade_selected = soda_selected['upgrade_coke'] + soda_selected['upgrade_diet_coke'] + soda_selected['upgrade_sprite'] + soda_selected['upgrade_fanta'] + soda_selected['upgrade_water'];
	if (pack_upgrade_selected != party_pack_upgrade){
		error = true;
		getErrPosition("#partyPack_upgrade_err");
		$("#partyPack_upgrade_err").text('Select all ' + party_pack_upgrade + ' flavors.');
	}

	// Check if there are any negative inputs
	if($("#extra_chips").val() < 0 || $("#extra_salsa").val() < 0 || $("#extra_guacamole").val() < 0 || $("#extra_sourcream").val() < 0) {
		return;
	}

	// Submit form
	if (!error){
		$('#order-form').submit();
	}else{
		$('html,body').animate({scrollTop:$(error_pos).offset().top - 50},500);
	}
});

function getErrPosition(id){
	if (error_pos == "none"){
        error_pos = id;
    }
}