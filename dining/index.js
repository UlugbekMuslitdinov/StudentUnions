(function main() {

    window.onload = function () {

        // document.getElementById("btn_enter_code").onClick = check_secret_code;

        // Get Form
        var form = document.forms['meal_package_form'];

        document.getElementById('dorm').onchange = function (e) {
            if (this.value == 'Babcock'){
                document.getElementById('order_total').innerHTML = '90';
            }
            else {
                document.getElementById('order_total').innerHTML = '30';
            }
        }

        form.onsubmit = OnSubmitForm;
     }

}());

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