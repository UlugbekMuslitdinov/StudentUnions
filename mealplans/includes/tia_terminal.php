<script src="/template/js/jquery-1.7.min.js"></script>
<script>
var test_cards = ["900100818", "375019001008180", "6329082000000000233", "375019001008200", "375019001008210", "375019001008220", "6329082000000000234", "375019001008240", "375019001008250", "375019001008260", "375019001008270", "6329082000000000235", "375019001008290", "6329082000000000236", "375019001008310"];

var tests = new Array(73);
var current_test = 0;
var online = "T";

tests[15] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};

tests[16] = form_values = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"10.23",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};

tests[17] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":".36",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};

tests[18] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":".45",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":1		
	};

tests[19] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"1.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":6		
	};

tests[20] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":".25",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":6		
	};
tests[21] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":"1600.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":6		
	};

tests[22] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"2000.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":6		
	};
tests[23] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.01",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[24] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.01",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":3		
	};
tests[25] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":"0.02",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[26] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":"0.02",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":3		
	};
tests[27] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.04",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[28] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":"0.25",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":6		
	};
tests[29] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[30] = {
		"manual":"T",
		"carddata":test_cards[0],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"451",
		"online":"T",
		"tran_type":4		
	};
tests[31] = {
		"manual":"F",
		"carddata":test_cards[1],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"451",
		"online":"F",
		"tran_type":4		
	};
tests[32] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":7		
	};
tests[33] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"43.21",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[34] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"6801.20",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":6		
	};
tests[35] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"1234.56",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":1		
	};
tests[36] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"77.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":6		
	};
tests[37] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"1.21",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":6		
	};
tests[38] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"2200.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"F",
		"tran_type":6		
	};
tests[39] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".35",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":6		
	};
tests[40] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":"1.00",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":6		
	};
tests[41] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".01",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[42] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".19",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":3		
	};
tests[43] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".02",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":3		
	};
tests[44] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".44",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":3		
	};
tests[45] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".02",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":6		
	};
tests[46] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".05",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"F",
		"tran_type":6		
	};
tests[47] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".00",
		"terminal_number":"3",
		"tend_num":"900",
		"online":"T",
		"tran_type":2		
	};
tests[48] = {
		"manual":"F",
		"carddata":test_cards[2],
		"amount":".00",
		"terminal_number":"3",
		"tend_num":"451",
		"online":"F",
		"tran_type":4		
	};
tests[49] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":".00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":2		
	};
tests[50] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"111.14",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[51] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":2		
	};
tests[52] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"0.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":7		
	};
tests[53] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"100.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[54] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"1.16",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[55] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"10.00",
		"terminal_number":"3",
		"tend_num":"600",
		"online":"T",
		"tran_type":6		
	};
tests[56] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"0.01",
		"terminal_number":"3",
		"tend_num":"600",
		"online":"T",
		"tran_type":8		
	};
tests[57] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"0.01",
		"terminal_number":"3",
		"tend_num":"600",
		"online":"T",
		"tran_type":8		
	};
tests[58] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"0.03",
		"terminal_number":"3",
		"tend_num":"600",
		"online":"T",
		"tran_type":8		
	};



tests[59] = {
		"manual":"F",
		"carddata":test_cards[4],
		"amount":"10.63",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[60] = {
		"manual":"F",
		"carddata":test_cards[5],
		"amount":"6780.53",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[61] = {
		"manual":"F",
		"carddata":test_cards[6],
		"amount":"7.79",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[62] = {
		"manual":"F",
		"carddata":test_cards[7],
		"amount":"2.22",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[63] = {
		"manual":"F",
		"carddata":test_cards[8],
		"amount":"1.21",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[64] = {
		"manual":"F",
		"carddata":test_cards[9],
		"amount":"52.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[65] = {
		"manual":"F",
		"carddata":test_cards[9],
		"amount":"49.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[66] = {
		"manual":"F",
		"carddata":test_cards[9],
		"amount":"49.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[67] = {
		"manual":"F",
		"carddata":test_cards[11],
		"amount":"1200.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[68] = {
		"manual":"F",
		"carddata":test_cards[12],
		"amount":"46.64",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[69] = {
		"manual":"F",
		"carddata":test_cards[14],
		"amount":"50.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[70] = {
		"manual":"F",
		"carddata":test_cards[14],
		"amount":"50.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[71] = {
		"manual":"F",
		"carddata":test_cards[10],
		"amount":"85.01",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[72] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"1.00",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
tests[73] = {
		"manual":"F",
		"carddata":test_cards[3],
		"amount":"25.16",
		"terminal_number":"3",
		"tend_num":"910",
		"online":"T",
		"tran_type":1		
	};
//define("DEBIT", '1');
//define("BALANCE_INQUIRY", '2');
//define("COUNT", '3');
//define("ACTIVITY", '4');
//define("REFUND", '5');
//define("DEPOSIT", '6');
//define("AUTHORIZATION_LIMIT", '7');
//define("CASH_EQUIVALENCY", '8');

function get_response(){
	var form = document.tia_terminal;
	var card = form.carddata.options[form.carddata.selectedIndex].value;
	if(card == "900100818")
		var manual = "T";
	else
		var manual = "F";
	
	var form_values = {
			"carddata":card,
			"amount":form.amount.value,
			"tend_num":form.tend_num.value,
			"tran_type":form.tran_type.options[form.tran_type.selectedIndex].value,
			"terminal_number":"3",
			"online":"T",
			"manual":manual
		};

	
$.post("tia.php", form_values, function(data){document.getElementById('result').innerHTML = data;}, "html");
	return false;
}

function run_offline(){
	online = "T";
	$.post("offlinetia.php", '', respond_to_test, "html");
}

function wait(millis) 
{
var date = new Date();
var curDate = null;

do { curDate = new Date(); } 
while(curDate-date < millis);
} 

function run_test_at(test_num){
	current_test = test_num;
	online = tests[current_test]["online"];
	$.post("tia.php", tests[test_num], respond_to_test, "html");
}

function respond_to_test(data){
	document.getElementById('result').innerHTML += "<h1>Test "+current_test+"</h1>"+data;
	if(tests[current_test]["online"] == "F" && tests[current_test+1]["online"] == "T" &&  online == "F"){
		run_offline();
		return true;
	}

	current_test++;

	if(current_test == 74)
		return true;
	else
		run_test_at(current_test);
}

/*
function run_tests(){
	
document.getElementById('result').innerHTML = '';
	
	var form_values = {
			"manual":"F",
			"carddata":test_cards[1],
			"amount":"0.00",
			"terminal_number":"3",
			"tend_num":"910",
			"online":"T",
			"tran_type":1		
		};
	$.post("tia.php", form_values, function(data){document.getElementById('result').innerHTML += "<h1>Test 15</h1>"+data;}, "html"); //test 15
	wait(2000);

	
	var form_values = {
			"manual":"F",
			"carddata":test_cards[1],
			"amount":"10.23",
			"terminal_number":"3",
			"tend_num":"910",
			"online":"T",
			"tran_type":1		
		};
	$.post("tia.php", form_values, function(data){document.getElementById('result').innerHTML += "<h1>Test 16</h1>"+data;}, "html"); //test 16
	wait(2000);

	
	var form_values = {
			"manual":"T",
			"carddata":test_cards[0],
			"amount":".36",
			"terminal_number":"3",
			"tend_num":"910",
			"online":"T",
			"tran_type":1		
		};
	$.post("tia.php", form_values, function(data){document.getElementById('result').innerHTML += "<h1>Test 17</h1>"+data;}, "html"); //test 17
	wait(2000);

	
	var form_values = {
			"manual":"F",
			"carddata":test_cards[1],
			"amount":".45",
			"terminal_number":"3",
			"tend_num":"910",
			"online":"F",
			"tran_type":1		
		};
	$.post("tia.php", form_values, function(data){document.getElementById('result').innerHTML += "<h1>Test 18</h1>"+data;}, "html"); //test 18
	wait(2000);

	run_offline();
	wait(4000);
	
}
*/
</script>
<form name="tia_terminal" onsubmit="return get_response()">
<div>
<select name="carddata">
	<option value="0000000000000000056789">0000000000000000056789</option>
	<option value="6017090000056789">6017090000056789</option>
	<option value="900100818">900100818(M)</option>
	<option value="375019001008180">375019001008180(1)</option>
	<option value="6329082000000000233">6329082000000000233(2)</option>
	<option value="375019001008200">375019001008200(3)</option>
	<option value="375019001008210">375019001008210(4)</option>
	<option value="375019001008220">375019001008220(5)</option>
	<option value="6329082000000000234">6329082000000000234(6)</option>
	<option value="375019001008240">375019001008240(7)</option>
	<option value="375019001008250">375019001008250(8)</option>
	<option value="375019001008260">375019001008260(9)</option>
	<option value="375019001008270">375019001008270(10)</option>
	<option value="6329082000000000235">6329082000000000235(11)</option>
	<option value="375019001008290">375019001008290(12)</option>
	<option value="6329082000000000236">6329082000000000236(13)</option>
	<option value="375019001008310">375019001008310(14)</option>
</select>
<input type="text" name="other_card" style="visibility: hidden"/>
</div>
<div>
Amount: <input type="text" name="amount" />
</div>
<div>
Tender number: <input type="text" name="tend_num" value="1" />
</div>

<div>
transaction type: 
<select name="tran_type">
<option value="1">Debit</option>
<option value="2">Balance Inquiry</option>
<option value="3">Coutn</option>
<option value="4">Activity</option>
<option value="5">Refund</option>
<option value="6" selected>Deposit</option>
<option value="7">Authorization Limit</option>
<option value="8">Cash Equivalency</option>
</select>
</div>
<input type="submit" value="submit" />
</form>
<input type="button" onclick="run_test_at(15)" value="run tests" />
<input type="button" onclick="run_offline()" value="run offline" />

<div id="result">

</div>