$(function() {

	$("dd").hide();

	$("dt").addClass('question').click(function() {

		$(this).next().toggle();

	});

	$("#show_dd").click(function() {

		$("dd").show().slideDown('slow');

	});

	$("#hide_dd").click(function() {

		$("dd").hide().slideUp('slow');

	});

});
