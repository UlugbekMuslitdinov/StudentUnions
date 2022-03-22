(function main() {

    window.onload = function () {
        // document.getElementById("btn_enter_code").onClick = check_secret_code;
        // Get Form
        var form = document.forms['meal_package_form'];
        document.getElementById('dorm').onchange = function (e) {
            if ((this.value == 'Apache-Santa Cruz') || (this.value == 'Babcock') || (this.value == 'Coconino') || (this.value == 'Kaibab-Huachuca') || (this.value == 'Other-3Days')){
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

function OnSubmitForm(e) {
    // var formData = new FormData(document.querySelector('form'));
    // document.getElementById('submit').style.display = 'none';
    // document.getElementById('loading-btn').style.display = 'block';

    let error = false;

    // const dorm = document.querySelector('#dorm').options.selectedIndex;
    // error = (dorm === 0) ? true : false; 

    document.querySelectorAll('#dorm, #').forEach(
        function(el){ 
            error = (el.options.selectedIndex === 0) ? true : false; 
            if (error){ return; }
        }
    );

    if (error){
        document.querySelectorAll('.alert_box').forEach(function(el){ el.style.display = 'block'; });
        return false;
    }

    return true;
}