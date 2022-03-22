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
    <title>UA BAAS Marketing</title>

    <!-- Bootstrap CSS -->
    <link href="<?= MEDIAROOT ?>/css/bootstrap.5.ua.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.digital.arizona.edu/lib/ua-brand-icons/v2.0.1/ua-brand-icons.min.css">
    <link href="<?= MEDIAROOT ?>/css/marketing-global-style.css" rel="stylesheet">
    <link href="<?= MEDIAROOT ?>/css/home-style.css" rel="stylesheet">

</head>
<body>
<!-- Header Bar + Logo -->
<?php
    include_once INCLUDEROOT . '/content-header.php';
?>

<div class="container  ">
    <div class="row">
        <div class="col-12">
            <form action="marketing-request/" method="get">
                <button type="submit" class="btn btn-default btn-icon-right posr" href="marketing-request/"
                        title="BAAS Marketing Request Form">Request Form&nbsp;<i class="btn-arrow-right ua-brand-right-point"  ></i>
                </button>
            </form>
        </div>
    </div>

</div>
<br/><br/>
<!-- Header Banner -->

<div class="banner-section" style="position:relative;padding:0;">
    <div class="row g-0">
        <div class="col-12 col-lg-12 col-md-12 col-sm-12" class="ptsImage" id="bg-catran-large2"
             style="margin:0;padding:0">
            <img src="public/images/marketing-home-banner.png" class="img-fluid" id="headerImage"
                 alt="UA Parking & Transportation Services"/>
        </div>
    </div>
    <!-- text box -->
    <div class="container floater-box">
        <div class="row floater-row">
            <div class="col-0 col-lg-8 col-md-6"></div>
            <div class="col-12 col-lg-4 col-md-6 col-sm-12 header-text-block">
                <div class="vertical-center">
                    <div class="headText">BAAS
                        <br/>MARKETING
                    </div>
                    <p class="box-body-text">We bring your stories and ideas to life! From individual campaigns to
                        large scale events, we showcase your products and services to the University community and
                        beyond!<br>
                    </p>
                    <form action="marketing-request/" name="link-form" method="get">
                        <button type="submit" style="left:15px;margin-top:5px;" class="btn btn-default btn-icon-right posr"
                                title="BAAS Marketing Request Form">CREATE&nbsp;<i class="btn-arrow-right ua-brand-right-point"  ></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-header-bar"></div>
</div>

<br><br>

<!-- Footer  -->
<?php
    include_once INCLUDEROOT . '/content-footer.php';
?>
<script src="<?= MEDIAROOT ?>/js/jquery3.6.0.js"></script>
<script src="<?= MEDIAROOT ?>/js/bootstrap.bundle.min.js"></script>

<script>

    $(document).ready(function () {

        var curSource = 'public/images/UA-marketing-home-banner-b.png';

        function adjustHeader() {
            var screenWidth = $(window).width()
            if (screenWidth < 600) {
                if (curSource !== 'public/images/marketing-home-banner-small2.png') {
                    curSource = 'public/images/marketing-home-banner-small2.png';
                    $('#headerImage').attr('src', curSource);
                }
            } else {
                if (curSource !== 'public/images/UA-marketing-home-banner-b.png') {
                    curSource = 'public/images/UA-marketing-home-banner-b.png';
                    $('#headerImage').attr('src', curSource);
                }
            }
        }
        adjustHeader();
        $(window).resize(function () {
            adjustHeader();
        });
    });
</script>
</body>
</html>
