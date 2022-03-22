function isArray(obj) {
   if (obj.constructor.toString().indexOf("Array") == -1)
      return false;
   else
      return true;
}

function confirmation()
{
  var send = confirm("Are you sure?");
  if (send)
  {
    document.post.innerHTML += '<input type="hidden" name="send">';
    document.forms[1].submit();
  }
}

function printable(id) {
  var printable_popup = window.open("printable.php?id=" + id, "outcomes", "width=800, height=800, scrollbars=yes");
  return;
}

// Main
function dsListOutcomes() {
  var outcome_popup = window.open("list_outcomes.php", "outcomes", "width=800, height=800, scrollbars=yes");
  return;
}

function textCounter(maxlimit) {
  var field = document.post.description;
  var countfield = document.post.remLen;
  
  if (field.value.length > maxlimit) {		// if too long...trim it!
    field.value = field.value.substring(0, maxlimit);
  } else {									// otherwise, update 'characters left' counter
    countfield.value = maxlimit - field.value.length;
  }
}

function addElement() {
  var budget = document.getElementById('budget_list');
  var prep = document.getElementById('list_prep');
  var newtr = budget.insertRow(budget.rows.length - 3);
  
  for (i = 0; i < prep.cells.length; i++)
  {
    var newtd = newtr.insertCell(i);
	newtd.innerHTML = prep.cells[i].innerHTML;
  }
}

function removeElement(r)
{
  var index = r.parentNode.parentNode.rowIndex;
  if (index > 1)
    document.getElementById('budget_list').deleteRow(index);
}

function calcEstimate() {
  try {
    var costs = document.post.elements["budget_cost[]"];
	var total = 0;
    for (i = 0; i < costs.length; i++)
    {
      total += (parseInt(costs[i].value) == costs[i].value) ? parseInt(costs[i].value) : 0;
    }
  } catch (e) {
    var costs = document.getElementById("budget_cost[]");
    var total = (parseInt(costs.value) == costs.value) ? parseInt(costs.value) : 0;
  }
  
  document.post.total_estimate.value = total;
  document.getElementById('total_estimate').innerHTML = '$' + total;
}

function calcTotal() {
  var income = parseInt(document.post.budget_income.value);
  var estimate = parseInt(document.post.total_estimate.value);
  document.post.total_balance.value = estimate - income;
}

function prepCompare(type) {
  // Total comparison notice
  if (document.post.budget_income.value != '')
  {
	if (parseInt(document.post.budget_income.value) + parseInt(document.post.request_amount.value) != parseInt(document.post.total_estimate.value))
    {
      document.getElementById('total').className = 'error';
      document.getElementById('total').innerHTML = 'The total estimate does not match your projected income and request amount';
    }
    else
    {
      document.getElementById('total').className = 'ok';
      document.getElementById('total').innerHTML = 'The total estimate matches the projected income and request amount';
    }
  }
  
  // Start request prep
  if (type == 'request')
  {
    //document.post.compare_request.value = document.post.request_amount.value;
	document.getElementById('add_request').innerHTML = '$' + document.post.request_amount.value;
	document.getElementById('compare_request').innerHTML = '$' + document.post.request_amount.value;
	
	//if (document.post.compare_itemized.value)
	if (document.getElementById('compare_itemized').innerHTML != '')
	  prepCompare();
  }
  // Request amount notice
  else
  {
    try {
      var requests = document.post.elements["budget_requested[]"];
	  var costs = document.post.elements["budget_cost[]"];
	  var total = 0;
	  for (i = 0; i < costs.length; i++)
      {
        if (requests[i].selectedIndex == 0)
          total += (parseInt(costs[i].value) == costs[i].value) ? parseInt(costs[i].value) : 0;
      }
    } catch (e) {
      var requests = document.getElementById("budget_requested[]");
      var costs = document.getElementById("budget_cost[]");
      var total = (requests.selectedIndex == 0) ? ((parseInt(costs.value) == costs.value) ? parseInt(costs.value) : 0) : 0;
    }
    
    //document.post.compare_itemized.value = total;
	document.getElementById('compare_itemized').innerHTML = '$' + total;
	
	// Comparison notice
	//if (document.post.compare_request.value != document.post.compare_itemized.value)
	if (document.getElementById('compare_request').innerHTML != document.getElementById('compare_itemized').innerHTML)
	{
      document.getElementById('compare').className = 'error';
      document.getElementById('compare').innerHTML = 'Your request amount does not match your itemized requests!';
	}
	else
	{
      document.getElementById('compare').className = 'ok';
      document.getElementById('compare').innerHTML =  'Your request amount matches your itemized requests';
	}
  }
}

function sampleBudget() {
  var sample_popup = window.open("budget_sample.php", "sample", "width=800, height=810, scrollbars=yes");
  return;
}

// Popup
function SelectOutcomes() {
  var outcomes = new Array();
  var elements = document.form.elements["outcomes[]"];
  for (i in elements)
  {
    if (elements[i].checked == true)
      outcomes.push(elements[i].value);
  }
  
  opener.document.post.outcomes.value = outcomes.join(', ');
  opener.focus();
  window.close();
  return true;
}