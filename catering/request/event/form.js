(function() {

    window.onload = function () {
        document.getElementById("checkbox").onclick = checkboxHandler;  

        document.getElementById("typeOfServiceSelect").onchange = serviceChangeHandler;

        let audiovisualRadios = document.getElementsByName("audiovisualRadio");
        for (let i=0; i < audiovisualRadios.length; i++) {
            audiovisualRadios[i].onchange = audioVisualHandler;
        }

        let recurringRadios = document.getElementsByName("recurringRadio");
        for (let i=0; i < recurringRadios.length; i++) {
            recurringRadios[i].onchange = recurringHandler;
        }

        let paymentRadios = document.getElementsByName("paymentRadio");
        for (let i=0; i < paymentRadios.length; i++) {
            paymentRadios[i].onchange = accontNumberHandler;
        } 

        document.getElementById('es-hour').onchange = function () {printTime('es-hour', 'es-min', 'es-mnemonic', 'event-start-time');}
        document.getElementById('es-min').onchange = function () {printTime('es-hour', 'es-min', 'es-mnemonic', 'event-start-time');}
        document.getElementById('es-mnemonic').onchange = function () {printTime('es-hour', 'es-min', 'es-mnemonic', 'event-start-time');}

        document.getElementById('ee-hour').onchange = function () {printTime('ee-hour', 'ee-min', 'ee-mnemonic', 'event-end-time');}
        document.getElementById('ee-min').onchange = function () {printTime('ee-hour', 'ee-min', 'ee-mnemonic', 'event-end-time');}
        document.getElementById('ee-mnemonic').onchange = function () {printTime('ee-hour', 'ee-min', 'ee-mnemonic', 'event-end-time');}

        document.getElementById('cs-hour').onchange = function () {printTime('cs-hour', 'cs-min', 'cs-mnemonic', 'catering-start-time');}
        document.getElementById('cs-min').onchange = function () {printTime('cs-hour', 'cs-min', 'cs-mnemonic', 'catering-start-time');}
        document.getElementById('cs-mnemonic').onchange = function () {printTime('cs-hour', 'cs-min', 'cs-mnemonic', 'catering-start-time');}

        document.getElementById('ce-hour').onchange = function () {printTime('ce-hour', 'ce-min', 'ce-mnemonic', 'catering-end-time');}
        document.getElementById('ce-min').onchange = function () {printTime('ce-hour', 'ce-min', 'ce-mnemonic', 'catering-end-time');}
        document.getElementById('ce-mnemonic').onchange = function () {printTime('ce-hour', 'ce-min', 'ce-mnemonic', 'catering-end-time');}

        var form = document.forms['eventForm'];
        form.onsubmit = OnSubmitForm;
    }

    function checkboxHandler() {
        // If a checkbox isn't check, make the input required.
        if (
            document.getElementById("checkbox1").checked ||
            document.getElementById("checkbox2").checked ||
            document.getElementById("checkbox3").checked ||
            document.getElementById("checkbox4").checked ||
            document.getElementById("checkbox5").checked ||
            document.getElementById("checkbox6").checked ||
            document.getElementById("checkbox7").checked 
           ) 
        {
            document.getElementById("checkbox-validation").required = false;
        } else {
            document.getElementById("checkbox-validation").required = true;
        }
    }

    function serviceChangeHandler() {
        // hides or displays catering information panel depending on type of service selected
        let cateringInfoDiv = document.getElementById("catering-information");
        if (this.value == "Meeting Space Only") {
            cateringInfoDiv.style.display = "none";
            document.getElementById("setup-style").required = true;
            document.getElementById("audiovisualRadio1").required = true;
        } 
        else if (this.value == 'Catering Only' ) {
            cateringInfoDiv.style.display = "block";
            document.getElementById("setup-style").required = false;
            document.getElementById("audiovisualRadio1").required = false;
            document.getElementById("audiovisualTextArea").required = false;
        }
        else {
            // Catering & Meeting Space
            document.getElementById("setup-style").required = true;
            document.getElementById("audiovisualRadio1").required = true;
            cateringInfoDiv.style.display = "block";
        }

        // if a panel is being displayed, make fields required.
        document.getElementById("checkbox-validation").required = this.value !== "Meeting Space Only";
        document.getElementById("catering-start-time").required = this.value !== "Meeting Space Only";
        document.getElementById("catering-end-time").required = this.value !== "Meeting Space Only";
        document.getElementById("servicewareRadio1").required = this.value !== "Meeting Space Only";

        // hides or displays location panel depending on type of service selected
        let locationDiv = document.getElementById("location");
        let roomInfoDiv = document.getElementById("room-info");
        if (this.value == "Catering Only") {
            locationDiv.style.display = "block";
            roomInfoDiv.style.display = "none";
        } else {
            locationDiv.style.display = "none";
            roomInfoDiv.style.display = "block";
        }
    }

    function audioVisualHandler() {
        // hides or displays audiovisual comment box depending on radio selection
        let audiovisualDiv = document.getElementById("audiovisualDiv");
        if (this.value === "Yes") {
            audiovisualDiv.style.display = "block";
        } else {
            audiovisualDiv.style.display = "none";
        }

        // if a panel is being displayed, make fields required.
        document.getElementById("audiovisualTextArea").required = this.value === "Yes";

    }

    function recurringHandler() {
        // hides or displays recurring comment box depending on radio selection
        let recurringDiv = document.getElementById("recurringDiv");
        if (this.value === "Yes") {
            recurringDiv.style.display = "block";
        } else {
            recurringDiv.style.display = "none";
        }

        // if a panel is being displayed, make fields required.
        document.getElementById("recurringTextArea").required = this.value === "Yes";

    }

    function accontNumberHandler() {
        // hides or displays account number div depending on radio selection
        let accountNumberDiv = document.getElementById("account-number-div");
        if (this.value === "account") {
            accountNumberDiv.style.display = "block";
        } else {
            accountNumberDiv.style.display = "none";
        }

        // if a panel is being displayed, make fields required.
        document.getElementById("account-number").required = this.value === "account";
        // document.getElementById("sub-account-number").required = this.value === "account";
    }

    function printTime(hr, min, mne, input) {
        // Check hour
        const tmp_hour = document.getElementById(hr).value !== '' ? document.getElementById(hr).value : '01';
    
        // Check min
        const tmp_min = document.getElementById(min).value !== '' ? document.getElementById(min).value : '00';
    
        // Check mne
        const tmp_mne = document.getElementById(mne).value !== '' ? document.getElementById(mne).value : 'AM';

        document.getElementById(input).value = tmp_hour + ':' + tmp_min + ' ' + tmp_mne;
    }

    function OnSubmitForm(e) {
        var formData = new FormData(document.querySelector('form'));
        document.getElementById('submit').style.display = 'none';
        document.getElementById('loading-btn').style.display = 'block';
        // fetch('/catering/request/event/mail-handler.php',{
        fetch('/api/catering/event/new',{
            method: 'post',
            body: formData,
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(json) {
            // if (json.response){
            if (json.success){
                document.getElementById('submit').style.display = 'block';
                document.getElementById('loading-btn').style.display = 'none';
                document.getElementById('thanks-msg').style.visibility = 'visible';
                // scrollOptions = {
                //     left: 0,
                //     top: 0,
                //     behavior: 'auto'
                // }
                // window.scrollTo(scrollOptions);
                document.forms['eventForm'].reset();
                return true;
            }
        });
    
        return false;
    }
    
}) ();