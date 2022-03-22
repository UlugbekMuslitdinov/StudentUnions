(function main() {

    window.onload = function () {
        // Get Form
        var form = document.forms['cakeForm'];

        // Display input when other is selected
        var occasions = form.elements['occasion'];
        for (var i = 0; i < occasions.length; i++){
            occasions[i].onchange = OnSelectOccasion;
        }
        var types = form.elements['cake-type'];
        for (var i = 0; i < types.length; i++){
            types[i].onchange = OnSelectType;
        }
        var themes = form.elements['theme'];
        for (var i = 0; i < themes.length; i++){
            themes[i].onchange = OnSelectTheme;
        }

        document.getElementById('et-hour').onchange = function () {printTime('et-hour', 'et-min', 'et-mnemonic', 'inputEventTime');}
        document.getElementById('et-min').onchange = function () {printTime('et-hour', 'et-min', 'et-mnemonic', 'inputEventTime');}
        document.getElementById('et-mnemonic').onchange = function () {printTime('et-hour', 'et-min', 'et-mnemonic', 'inputEventTime');}

        form.onsubmit = OnSubmitForm;
     }

}());

function OnSelectOccasion(e) {
    if (this.value == 'Other'){
        document.getElementById('ifOtherOccasion').style.visibility = 'visible';
    }
    else {
        document.getElementById('ifOtherOccasion').style.visibility = 'hidden';
    }
}

function OnSelectType(e) {
    if (this.value == 'Custom'){
        document.getElementById('ifCustomType').style.visibility = 'visible';
    }
    else {
        document.getElementById('ifCustomType').style.visibility = 'hidden';
    }
}

function OnSelectTheme(e) {
    console.log(this.value);
    if (this.value == 'Custom'){
        document.getElementById('ifCustomTheme').style.visibility = 'visible';
    }
    else {
        document.getElementById('ifCustomTheme').style.visibility = 'hidden';
    }
}

function showfield(name){
    if(name=='Other')document.getElementById('div1').innerHTML='<input class="form-control" type="text" name="other" placeholder="Type in here" />';
    else document.getElementById('div1').innerHTML='';
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
    fetch('/catering/request/cake/mail.php',{
        method: 'post',
        body: formData,
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        if (json.response){
            document.getElementById('submit').style.display = 'block';
            document.getElementById('loading-btn').style.display = 'none';
            document.getElementById('thanks-msg').style.visibility = 'visible';
            // scrollOptions = {
            //     left: 0,
            //     top: 0,
            //     behavior: 'auto'
            // }
            // window.scrollTo(scrollOptions);
            document.forms['cakeForm'].reset();
            return true;
        }
    });

    return false;
}

