(function main() {

    window.onload = function () {
        // document.getElementById("btn_enter_code").onClick = check_secret_code;
        // Get Form
        var form = document.forms['meal_package_form'];
        document.getElementById('dorm').onchange = function (e) {
            if ((this.value == 'Apache-Santa Cruz') || (this.value == 'Babcock') || (this.value == 'Coconino') || (this.value == 'Coronado') || (this.value == 'Kaibab-Huachuca') || (this.value == 'Other-3Days')){
                document.getElementById('order_total').innerHTML = '90';
				document.getElementById('order_total_2').innerHTML = '90';	
				document.forms['meal_package_form'].order_total_hidden.value = '90';
				document.forms['meal_package_form'].order_total_hidden_2.value = '90';
            }
            else {
                document.getElementById('order_total').innerHTML = '30';
				document.getElementById('order_total_2').innerHTML = '30';
				document.forms['meal_package_form'].order_total_hidden.value = '30';
				document.forms['meal_package_form'].order_total_hidden_2.value = '30';
            }
        }
        form.onsubmit = OnSubmitForm;
     }
}());

// Calculate amount with the water selection.
function selectWater($num) {
	// This amount won't change at each radio button clicking.
	var total_amount = parseInt(document.forms['meal_package_form'].order_total_hidden.value); 
	var new_total = total_amount + $num;
	document.getElementById('order_total').innerHTML = new_total;
	document.getElementById('order_total_2').innerHTML = new_total;
	document.forms['meal_package_form'].order_total_hidden_2.value = new_total; 
}

// Form validation
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(inputtxt)
{
    return inputtxt.match(/\d/g).length===10;
}

function formValidation() {
    var dorm = document.forms["meal_package_form"]["dorm"].value;
    var meal = document.forms["meal_package_form"]["meal"].value;
    var refr = document.forms["meal_package_form"]["refrigerator"].value;
    var microwave = document.forms["meal_package_form"]["microwave"].value;
    var water = document.forms["meal_package_form"]["water"].value;
    var requests = document.forms["meal_package_form"]["requests"].value;
    var email = document.forms["meal_package_form"]["email"].value;
    var first_name = document.forms["meal_package_form"]["first_name"].value;
    var last_name = document.forms["meal_package_form"]["last_name"].value;
    var phone = document.forms["meal_package_form"]["phone"].value;
    var room_number = document.forms["meal_package_form"]["room_number"].value;
    var payment = document.forms["meal_package_form"]["payment"].value;

    // console.log(dorm);
    // console.log(meal);
    // console.log(refrigerator);
    // console.log(microwave);
    // console.log(water);
    // console.log(requests);
    // console.log(email);
    // console.log(first_name);
    // console.log(last_name);
    // console.log(phone);
    // console.log(room_number);
    // console.log(payment);

    if(dorm == "" || meal == "" || refr == "" || microwave == "") {
        return false;
    }

    if(first_name.trim() == "" || last_name.trim() == "" || room_number.trim() == "" || payment == "") {
        return false;
    }

    if(!validateEmail(email) || !validatePhone(phone)) {
        return false;
    }

    return true;
}
//

function OnSubmitForm() {
    // var formData = new FormData(document.querySelector('form'));
    // document.getElementById('submit').style.display = 'none';
    // document.getElementById('loading-btn').style.display = 'block';

    let error = false;

    // const dorm = document.querySelector('#dorm').options.selectedIndex;
    // error = (dorm === 0) ? true : false; 

    error = !formValidation();


    // document.querySelectorAll('#dorm, #').forEach(
    //     function(el){ 
    //         error = (el.options.selectedIndex === 0) ? true : false; 
    //         if (error){ return; }
    //     }
    // );

    if (error){
        document.querySelectorAll('.alert_box').forEach(function(el){ el.style.display = 'block'; });
        return false;
    }

    return true;
}