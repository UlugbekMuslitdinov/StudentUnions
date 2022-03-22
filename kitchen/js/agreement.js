


/*
	Display different policy when restaurant is selected
*/
$('#select_restaurant').on('change',function(){
	var selected_restaurant = $(this).val();

	// Use ajax or something to change policy
	// $.post("select_restaurant.post.php", function(data, status){
        
 //    });

 	// Set restaurant value
 	// highland_burrito is default
 	$('#hidden_restaurant').val(selected_restaurant);
});


