
// 
var currentTime = new Date ();
var minTime = new Date ( currentTime );
// minTime.setHours ( currentTime.getHours() + 2 );
var minHour = minTime.getHours();
var str_minHour = '';
var minDate = 0;
var bool_today = true;

$('body').on('focus',".datepicker", function(){
    setMinHour();

    // if it is 8 p.m. then display next date
    if (minHour > 20){
        minDate = 1;
    }

    $(this).datepicker({
		"showAnim":"fadeIn",
		"dateFormat":"mm/dd/yy",
        // "dateFormat":"yy-mm-dd",
		showButtonPanel: true,
        "minDate": minDate,
        onSelect: function (date) {
            var selected_day = new Date(date);
            // if date is not today then time must display all hours
            if (selected_day.toDateString() != currentTime.toDateString()){
                bool_today = false;
            }else {
                bool_today = true;
            }

            // set minimum hour for timepicker
            if (bool_today){
                // user selected today
                setMinHour();
            }else {
                // not today, all hours available to order
                minHour = 3;
            }
            
            // if (minHour <= 4){
            //     str_minHour = "6:00am";
            // }else if (minHour > 20){
            //     str_minHour = "6:00am";
            // }else{
            //     str_minHour = minHour + ":00";
            // }
            // $('.timepicker').timepicker('option', 'minTime', str_minHour);

            // $('#delivery_time').val("");

            // Remove err class
            $("#delivery_date").removeClass("inputBox-err");
        }
	});
});



//I need to reload timepicker ?
$('body').on('focus',".timepicker", function(){

    if ($("#delivery_date").val().length !== 0){
        // console.log($("#delivery_date").val());
        // $(this).timepicker({ 
        // 	'timeFormat': 'h:i A',
        //     'minTime': str_minHour,
        //     'maxTime': '10:00pm',
        //     'step': 15,
        // 	'scrollDefault': str_minHour,
        // 	'autoclose': true,
        //     'disableTextInput': true
        //     // 'useSelect': true
        // });
        // $(this).on('selectTime', function() {
    	//     $(this).timepicker('hide');	
        //     // Remove err class
        //     $(this).removeClass("inputBox-err");
        //     console.log(this.value);
    	// });
    }
});

function setMinHour(){
    // currentTime = new Date ();
    minTime = new Date ( currentTime );
    minTime.setHours ( currentTime.getHours() + 2 );
    minHour = minTime.getHours();
}

$('#deliveryOption_pickup').click(function(){
    // Pick up
    $('.delivery-message').css({"font-size": "12pt", "color": "black"});
    $('.delivery-option-pickup').addClass('btn-success');
    $('.delivery-option-delivery').removeClass('btn-success');
    $(".wrap_delivery_info").hide();
    $("#special_note > label").text("Note");
    $(".sameasOnsite").hide();
    $("#date_label").text("Pickup Date");
    $("#time_label").text("Pickup Time");

    // Remove err msg
    $("#delivery_option_err").text("");
    $("#delivery_option_err2").text("");
});

$('#deliveryOption_delivery').click(function(){
    // Delivery
    $('.delivery-message').css({"font-size": "14pt", "color": "red"});
    $('.delivery-option-delivery').addClass('btn-success');
    $('.delivery-option-pickup').removeClass('btn-success');
    $(".wrap_delivery_info").show();
    $("#special_note > label").text("Delivery Notes");
    $(".sameasOnsite").show();
    $("#date_label").text("Delivery Date");
    $("#time_label").text("Delivery Time");

    // Remove err msg
    $("#delivery_option_err").text("");
    $("#delivery_option_err2").text("");
});

// Validate Delivery Date
var regExpDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/i;
$("#delivery_date").bind("change focusout", function(){
    if(!regExpDate.test($(this).val()) ){
        $(this).val("");
    }
});

// Validate Delivery Time
var regExpTime = /(((0[1-9])|(1[0-2])):([0-5])(0|5)\s(A|P|a|p)(M|m))$/i;
// $("#delivery_time").bind("change focusout", function(){
//     if(!regExpTime.test($(this).val()) ){
//         $(this).val("");
//     }
// });
$("#hour").bind("change", function() {
    printTime();
});

$("#min").bind("change", function() {
    printTime();
});

$("#mnemonic").bind("change", function() {
    printTime();
});

function printTime() {
    // Check hour
    var tmp_hour = '01';
    if ($("#hour").val() != ''){
        tmp_hour = $("#hour").val();
    }

    // Check min
    var tmp_min = '00';
    if ($("#min").val() != ''){
        tmp_min = $("#min").val();
    }

    // Check mne
    var tmp_mne = 'AM';
    if ($("#mne").val() != ''){
        tmp_mne = $("#mnemonic").val();
    }

    $("#delivery_time").val(tmp_hour + ':' + tmp_min + ' ' + tmp_mne);
}


// Check delivery building and room number
$("#delivery_building").bind("change focusout", function(){
    // Check input
    checkInput("#delivery_building");
});
$("#delivery_room").bind("change focusout", function(){
    // Check input
    checkInput("#delivery_room");
});

// Validate phone number
var regExpPhone = /\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b$/i;
$("#onsite_phone, #customer_phone").on("focusout", function(){
    if(!regExpPhone.test($(this).val()) ){
        $(this).val("");
    }
});


// Check if idb account is selected, then opens input box
$('input[name="payment_method"]').click(function(){
	if ($('#idb_acc').is(':checked')){
		$('#uaidb_input').show();
        $('#idb_acc_num').focus();
		$('#uaidb_code_wrap').show();
	}else {
		$('#uaidb_input').hide();
		$('#uaidb_code_wrap').hide();
        $("#idb_acc_num").val("");
        $("#uaidb_code").val("");
	}
    $("#payment_opt_err").text("");
});

$("#idb_acc_num").bind("change keydown keyup focusout", function(){
    if ( $(this).val().replace(/ /g,'') == "" ){
        $("#payment_opt_err").text("Enter the account number");
    }else {
        $("#payment_opt_err").text("");
    }
});


/*
 * Same as on-site contact
 */
// if checked then copy contact from onsite
$("#sameAsOnsite").bind("change", function(){
    if ( $(this).is(":checked") ){
        $("#customer_name").val($("#onsite_name").val());
        $("#customer_name").focusout();
        $("#customer_email").val($("#onsite_email").val());
        $("#customer_email").focusout();
        $("#customer_phone").val($("#onsite_phone").val());
        $("#customer_phone").focusout();
    }else {
        $("#customer_name").val("");
        $("#customer_email").val("");
        $("#customer_phone").val("");
    }
});

// 
$("#onsite_name").bind("change keyup focusout", function(){
    checkInput("#onsite_name");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#customer_name").val($("#onsite_name").val());
        checkInput("#customer_name");
    }else {
        // $("#customer_name").val("");
    }
});

$("#onsite_email").bind("change keyup focusout", function(){
    checkInput("#onsite_email");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#customer_email").val($("#onsite_email").val());
        checkInput("#customer_email");
    }
});

$("#onsite_phone").bind("change keyup focusout", function(e){
    // noAlphabet(e);
    checkInput("#onsite_phone");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#customer_phone").val($("#onsite_phone").val());
        checkInput("#customer_phone");
    }else {
        // $("#customer_phone").val("");
    }

});

/*
 * Customer Information
 */
$("#customer_name").bind("change keyup focusout", function(){
    checkInput("#customer_name");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#onsite_name").val($("#customer_name").val());
        checkInput("#onsite_name");
    }else {
        // $("#customer_name").val("");
    }
});
$("#customer_email").bind("change keyup focusout", function(){
    checkInput("#customer_email");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#onsite_email").val($("#customer_email").val());
        checkInput("#onsite_email");
    }else {
        // $("#customer_name").val("");
    }
});
$("#customer_phone").bind("change keyup focusout", function(e){
    noAlphabet(e);
    checkInput("#customer_phone");
    if ( $("#sameAsOnsite").is(":checked") ){
        $("#onsite_phone").val($("#customer_phone").val());
        checkInput("#onsite_phone");
    }else {
        // $("#customer_phone").val("");
    }
});

function checkInput(id){
    if ($(id).val().replace(/ /g,'') == ""){
        $(id).addClass("inputBox-err");
    }else{
        $(id).removeClass("inputBox-err");
    }
}

function noAlphabet(event){
    // var regExp = /[a-z]/i;
    // var value = String.fromCharCode(event.which) || event.key;

    // // No letters
    // if (regExp.test(value)) {
    //     event.preventDefault();
    //     return false;
    // }
}



/* 
 *
 *   SUBMIT FORM
 *
 */
 var error_pos = "none";
$("#form_cust_info").submit(function(){
    var error = false;
    error_pos = "none";

    if ( $(".wrap-delivery-option").find('input:checked').length == 0 ){
        error = true;
        $("#delivery_option_err").text("Pick up OR Delivery?");

        getErrPosition("#delivery_option_err");
    }  

    // Check Date
    if ($("#delivery_date").val().replace(/ /g,'') == ""){
        error = true;
        $("#delivery_date").addClass("inputBox-err");

        getErrPosition("#delivery_date");
    }

    // Check Time
    if ($("#delivery_time").val().replace(/ /g,'') == ""){
        error = true;
        $("#delivery_time").addClass("inputBox-err");

        getErrPosition("#delivery_time");
    }

    var date_time_string = $("#delivery_date").val() + ' ' + $("#delivery_time").val();
    var date_time_obj = new Date(date_time_string);
    var curr_date = new Date();
    var diff = (date_time_obj - curr_date)/(60 * 60 * 1000);

    if(diff < 24) {
        error = true;
        $("#delivery_date").addClass("inputBox-err");
        $("#delivery_time").addClass("inputBox-err");

        getErrPosition("#delivery_time");

        $("#delivery_option_err2").text("Your order is within 24 hours. Please call 520-621-1945 to place order.");
    }
    else {
        $("#delivery_option_err2").text("");
    }

    // Check delivery detail when delivery is selected.
    if ($("#deliveryOption_delivery").is(":checked")){
        // Check Delivery Details
        var delivery_detail = ["#delivery_building", "#delivery_room","#onsite_name","#onsite_phone"];
        for (var i = 0; i < delivery_detail.length; i++) {
            temp_text = $(delivery_detail[i]).val().replace(/ /g,'');
            if (!temp_text){
                error = true;
                $(delivery_detail[i]).addClass("inputBox-err");

                getErrPosition(delivery_detail[i]);
            }
        }
    }

    // Check Customer Information
    var customer_info = ["#customer_name","#customer_email","#customer_phone"];
    for (var i = 0; i < customer_info.length; i++) {
        temp_text = $(customer_info[i]).val().replace(/ /g,'');
        if (!temp_text){
            error = true;
            $(customer_info[i]).addClass("inputBox-err");

            getErrPosition(customer_info[i]);
        }
    }

    // Check Payment Information
    if ($('input[name=payment_method]:checked').length == 0) {
        // console.log("not checked");
        $("#payment_opt_err").text("Check one of the options");
        error = true;

        getErrPosition("#payment_opt_err");
    }else{
        if ( $("#idb_acc").is(":checked") && $('#idb_acc_num').val().replace(/ /g,'') == "" ){
            error = true;
            $("#payment_opt_err").text("Enter the account number.");
            
            getErrPosition("#payment_opt_err");
        }
    }

    // console.log(error_pos);
    // console.log($(error_pos).offset().top);

    // Submit form
    if (error){
        $('html,body').animate({scrollTop:$(error_pos).offset().top - 50},500);
        return false;
    }
});

function getErrPosition(id){
    if (error_pos == "none"){
        error_pos = id;
    }
}

