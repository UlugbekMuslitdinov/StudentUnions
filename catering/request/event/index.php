<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/template/catering.inc.php');
$page_options['title'] = 'Catering';
$page_options['page'] = 'Catering';
// $page_options['header_image'] = '/catering/template/Banner_Catering_Form.png';
$page_options['header_image'] = '/catering/images/catering_banner.jpg';
catering_start($page_options);
?>

<style>
    .cc_top > img { 
        vertical-align: top;
        width: 100%; 
    }
    .c_content {
        height: initial;
    }
    h2 {
        text-align: center;
        margin-top: 0.5em;
        color: white;
        background-color: #0c234b;
        border-radius: 10px;
        margin-left: 8em;
        margin-right: 8em;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
        font-weight: bold;
    }
    .col-10 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .cc_right {
        margin-top: 90px;
    }
    .ccr_nav {
        height: initial;
    }
    #root {
        padding-left: 20px;
    }
</style>


<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/request/event/form.view.php'); ?>

<?php 
catering_finish()
?>