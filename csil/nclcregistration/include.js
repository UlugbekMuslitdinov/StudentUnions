function redirect(location)
{
	window.location = location;
}

function primaryGuest(attend)
{
	if (attend.checked)
	{
		// Auto fill elements
		document.reg.elements["guest[1][firstname]"].value = document.reg.elements["contact[firstname]"].value;
		document.reg.elements["guest[1][lastname]"].value = document.reg.elements["contact[lastname]"].value;
		document.reg.elements["guest[1][school]"].value = document.reg.elements["contact[school]"].value;
		document.reg.elements["guest[1][schooletc]"].value = document.reg.elements["contact[schooletc]"].value;
		document.reg.elements["guest[1][organization]"].value = document.reg.elements["contact[organization]"].value;
		document.reg.elements["guest[1][email]"].value = document.reg.elements["contact[email]"].value;
		document.reg.elements["guest[1][phone]"].value = document.reg.elements["contact[phone]"].value;
		document.reg.elements["guest[1][address1]"].value = document.reg.elements["contact[address1]"].value;
		document.reg.elements["guest[1][address2]"].value = document.reg.elements["contact[address2]"].value;
		document.reg.elements["guest[1][city]"].value = document.reg.elements["contact[city]"].value;
		document.reg.elements["guest[1][state]"].value = document.reg.elements["contact[state]"].value;
		document.reg.elements["guest[1][zip]"].value = document.reg.elements["contact[zip]"].value;
		
		// Highlight unfilled elements
		document.reg.elements["guest[1][age]"].className = 'error_field';
		document.reg.elements["guest[1][gender]"].className = 'error_field';
		document.reg.elements["guest[1][class]"].className = 'error_field';
		document.reg.elements["guest[1][meal]"].className = 'error_field';
		document.reg.elements["guest[1][sandwich]"].className = 'error_field';
		document.reg.elements["guest[1][international]"].className = 'error_field';
		try {document.reg.elements["guest[1][shirt]"].className = 'error_field';} catch(e) {};
	}
	else
	{
		// Clear auto fill
		document.reg.elements["guest[1][firstname]"].value = '';
		document.reg.elements["guest[1][lastname]"].value = '';
		document.reg.elements["guest[1][school]"].value = '';
		document.reg.elements["guest[1][schooletc]"].value = '';
		document.reg.elements["guest[1][organization]"].value = '';
		document.reg.elements["guest[1][email]"].value = '';
		document.reg.elements["guest[1][phone]"].value = '';
		document.reg.elements["guest[1][address1]"].value = '';
		document.reg.elements["guest[1][address2]"].value = '';
		document.reg.elements["guest[1][city]"].value = '';
		document.reg.elements["guest[1][state]"].value = '';
		document.reg.elements["guest[1][zip]"].value = '';
		
		// Remove highlight
		document.reg.elements["guest[1][age]"].className = '';
		document.reg.elements["guest[1][gender]"].className = '';
		document.reg.elements["guest[1][class]"].className = '';
		document.reg.elements["guest[1][meal]"].className = '';
		document.reg.elements["guest[1][sandwich]"].className = '';
		document.reg.elements["guest[1][international]"].className = '';
		try {document.reg.elements["guest[1][shirt]"].className = '';} catch(e) {};
	}
}

function autoTest()
{
		document.reg.elements["contact[firstname]"].value = 'Test';
		document.reg.elements["contact[lastname]"].value = 'Tester';
		document.reg.elements["contact[school]"].value = '1';
		document.reg.elements["contact[schooletc]"].value = '';
		document.reg.elements["contact[organization]"].value = '1';
		document.reg.elements["contact[email]"].value = 'test@test.com';
		document.reg.elements["contact[phone]"].value = '555-5555';
		document.reg.elements["contact[address1]"].value = 'test';
		document.reg.elements["contact[address2]"].value = '';
		document.reg.elements["contact[city]"].value = 'Tucson';
		document.reg.elements["contact[state]"].value = 'AZ';
		document.reg.elements["contact[zip]"].value = '85719';
		
		document.reg.elements["guest[1][firstname]"].value = 'Test';
		document.reg.elements["guest[1][lastname]"].value = 'Tester';
		document.reg.elements["guest[1][age]"].value = '20';
		document.reg.elements["guest[1][sandwich]"].value = '1';
		document.reg.elements["guest[1][shirt]"].value = '1';
		document.reg.elements["guest[1][school]"].value = '1';
		document.reg.elements["guest[1][schooletc]"].value = '';
		document.reg.elements["guest[1][organization]"].value = '1';
		document.reg.elements["guest[1][email]"].value = 'test@test.com';
		document.reg.elements["guest[1][phone]"].value = '555-5555';
		document.reg.elements["guest[1][address1]"].value = 'test';
		document.reg.elements["guest[1][address2]"].value = '';
		document.reg.elements["guest[1][city]"].value = 'Tucson';
		document.reg.elements["guest[1][state]"].value = 'AZ';
		document.reg.elements["guest[1][zip]"].value = '85719';
}

function autoCard()
{
	document.forms[0].billTo_firstName.value = 'Test';
	document.forms[0].billTo_lastName.value = 'Tester';
	document.forms[0].billTo_street1.value = 'test';
	document.forms[0].billTo_city.value = 'Tucson';
	document.forms[0].billTo_state.value = 'AZ';
	document.forms[0].billTo_postalCode.value = '85719';
	document.forms[0].billTo_email.value = 'test@test.com';
	document.forms[0].billTo_phoneNumber.value = '555-5555';
	document.forms[0].card_cardType.value = '001';
	document.forms[0].card_accountNumber.value = '4111111111111111';
	document.forms[0].card_expirationMonth.value = '09';
	document.forms[0].card_expirationYear.value = '2010';
	document.forms[0].card_cvNumber.value = '000';
}