function update()
  {
    var total = 0;
    var num = document.forms[0].num.value;
    for (i = 0; i < num; i++)
    {
      // BBQ (check if student)
      if (document.forms[0]["bbq["+i+"]"].checked == true) {
	    total += (document.forms[0]["uastudent["+i+"]"].checked == true) ? 5 : 10;
	  }
	  
	  // Student
	  if (document.forms[0]["uastudent["+i+"]"].checked == true) {
	  	document.getElementById('bbqcost'+i).innerHTML = '$5&nbsp;&nbsp;';
	  }
	  else {
	  	document.getElementById('bbqcost'+i).innerHTML = '$10';
	  }
	
      // Brunch
      if (document.forms[0]["brunch["+i+"]"].checked == true)
        total += 20;
    }
    document.getElementById('total').innerHTML = '<h2 style="margin:0;color:#513023;">Total:</h2> $' + total;
  }

  window.onload = function(){update();};