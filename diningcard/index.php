<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/dining/template/dining.inc');
  $page_options['header_image'] = '/template/images/banners/dep_dining_card_banner.jpg';
  $page_options['page'] = 'Departmental Dining Card';
	$page_options['title'] = 'Departmental Dining Card';
	dining_start($page_options);
?>
<h1>Departmental Dining Card</h1>
 
<p>The Arizona Student Unions are offering all University departments the Student Union Dining Card&#151;a departmental charge card that allows departments to charge dining transactions directly to their appropriate FRS Account and Object Code 5170 (Business Meeting Expense).</p>
<p>Departments have found the convenience of the card invaluable as they host campus guests, job candidates, and business meetings. The Student Union Dining Card is accepted at all campus food service locations and is issued at no cost to your department. The card can also be customized with the name of the authorized individual and department to whom the card is issued.</p>
<p>Application forms are available here or can be faxed to your department by calling our business office at 621-1417.</p>
 
<h2 style="margin-top: 15px; margin-bottom: -5px;">Download the Departmental Dining Card Application</h2>
<p>Fill it out and turn it in to the Meal Plan office</p>
<p style="margin-left: 15px; "><a href="/diningcard/SUDiningCardApp.pdf" style="font-size: 1.25em;">Dining Card Application</a> (47kb)</p>
							
<?php dining_finish(); ?>