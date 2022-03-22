<?php

    $docRoot = "/";

    define('APPROOT', $_SERVER['DOCUMENT_ROOT']);
    define('BASEROUTE', '/');
    define('MEDIAROOT', '/public');
    define('INCLUDEROOT', $_SERVER['DOCUMENT_ROOT'] . '/inc'); 

  /*   $docRoot = "/marketing";

    define('APPROOT', $_SERVER['DOCUMENT_ROOT'] . '/marketing');
    define('BASEROUTE', '/marketing');
    define('MEDIAROOT', '/marketing/public');
    define('INCLUDEROOT', $_SERVER['DOCUMENT_ROOT'] . '/marketing/inc'); */

?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <link href="<?= MEDIAROOT ?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.digital.arizona.edu/lib/ua-brand-icons/v2.0.1/ua-brand-icons.min.css">
    <link href="<?= MEDIAROOT ?>/css/marketing-global-style.css" rel="stylesheet">
    <link href="<?= MEDIAROOT ?>/css/home-style.css" rel="stylesheet">
    <title>UA BAAS Marketing : Marketing Request Form</title>

</head>
<body>
<!-- Header Bar + Logo -->
<?php
    include_once INCLUDEROOT . '/content-header.php';
?>

<div class="container">
    <h1 class="cfs-24">Please use this form to submit your marketing requests.</h1>
    <p class="have-questions">If you have any questions or unique requests, please contact us at
        <b>baas-mkt@arizona.edu</b>.</p><br>
    <div class=".stretch-container">
        <iframe src="https://forms.monday.com/forms/embed/20406a3aed829f7b6e26d928782b57bb?r=use1" scrolling="no"
                class="marking-frame" id="formFrame"
                style="border: 0;overflow: hidden"></iframe>
    </div>
</div>

<br><br>

<!-- Footer  -->
<?php
    include_once INCLUDEROOT . '/content-footer.php';
?>
<script src="<?= MEDIAROOT ?>/js/jquery3.6.0.js"></script>
<script src="<?= MEDIAROOT ?>/js/bootstrap.bundle.min.js"></script>

</body>
</html>