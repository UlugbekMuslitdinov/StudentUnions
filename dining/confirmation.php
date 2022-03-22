<?php
    session_start();

    // Clear Session
    $_SESSION['mealpackage'] = NULL;

	require_once($_SERVER['DOCUMENT_ROOT'] .'/dining/template/dining.inc');
	// include($_SERVER['DOCUMENT_ROOT'] . '/dining/mealpackage/include/main.php');

	// loginCheck();

	$page_options['page'] = 'Meal Package Order Confirmation';
	
    page_start($page_options);
?>
<link rel="stylesheet" type="text/css" href="/dining/mealpackage/index.css">

<h2 class="mb-4">Meal Package Order Confirmation</h2>

<div class="col-md-12">
    <div class="alert alert-success mt-3 mb-3" role="alert" id="thanks-msg">
        <b>Thank you for your order. We will review and contact you if we have questions.</b>
    </div>
</div>

<?php
page_finish();
?>
