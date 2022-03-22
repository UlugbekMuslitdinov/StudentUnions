


/*
	Display different policy when restaurant is selected
*/
$('#select_restaurant').on('change',function(){
	var selected_restaurant = $(this).val();

	// Use ajax or something to change policy
	$.post("/catering/online/policy/" + selected_restaurant + ".php", function(data, status){
        $('#ul_policy').html(data);
        if (selected_restaurant == 'highland_burrito')
        {
        	$('#banner_img').attr('src', '/catering/online/img/highland_banner.jpg');
        }
        else
        {
        	$('#banner_img').attr('src', '/catering/online/img/'+selected_restaurant+'_banner.jpg');
        }
    });

 	// Set restaurant value
 	// highland_burrito is default
 	$('#hidden_restaurant').val(selected_restaurant);
});


