<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T7QFBZH');</script>
<!-- End Google Tag Manager -->
<?php
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	// require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	require_once($_SERVER['DOCUMENT_ROOT'].'/employment/template/employment.include.php');
	$page_options['title'] = 'Employment Opportunities';
	$page_options['head'] = '';
	$page_options['page'] = 'Student Job Application';
  	// $page_options['header_image'] = '/template/images/banners/student_employment.png';
	// $page_options['header_image'] = '/template/images/banners/employment_unions_banner.jpg';
	employment_start($page_options);
session_start();
?>


<script>
    function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-CONVERSION_ID/CONVERSION_LABEL',
            'value': 1.0,
            'currency': 'USD',
            'event_callback': callback
        });
        return false;
    }
</script>

<style>
body {
	font-family: "Proxima Nova" !important;
}

*, *::after, *::before {
	box-sizing: border-box;
}
.modal {
	font-family: "Proxima Nova" !important;
}
.modal-dialog {
	top: 250px;
	width: 1250px;
	min-width: 1000px;
	max-height:200px;
	height:309px;
	min-width:50vw;
	max-width:100vw;
}
.modal-header {
	padding: 10px 15px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	border-style: solid;
	/*border-bottom: 1px solid black;*/
}
.modal-body {
	position: flex;

	align-self:stretch;	
}
.modal-content {
	position:flex;
	align-items:flex-start;
}
.modal-img {
	position: relative;
	width: 309px;
	height:400px;
	align-self:stretch;

}
input[type="submit"] {
    background: url(./images/submit.png) no-repeat;
    /* position: relative;
    top: ;
    left: ; */
    width: 105px;
    height: 27px;
    border : none;
    color : transparent;
    font-size : 0;
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover;
}
.btn-secondary, .button-submit {
    position:relative;
    left: 20px;
    top: 10px;
    width: 105px;
    height: 28px;
    margin: 10 auto;
    padding: 0;
    display: table-cell;
    vertical-align: middle;
    font-size: 20px;
    font-weight: bold;
}
label {
	font-family: "Proxima Nova", Garamond, Georgia, Helvetica, Arial !important;
	font-size: 24px;
	font-weight:bold;
}
.p-header {
    color:#ac051f; 
    font-weight:bold; 
    font-size:36px; 
    font-family: "Proxima Nova", Garamond, MiloWeb, Verdana, sans-serif !important;
    text-align: center;
}
input[type="radio"] {
	margin: 10px;
}
.join {
    /*arizona red*/
    color: #AB0520;
    font-size: 48px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 35px;
}
.employmentHeader {
    /*oasis*/
    color: #378DBD;
    font-size: 27px;
    font-weight: bold;
	text-decoration: underline;
}
.employmentText {
    color: black;
    font-size: 20px;
	margin-bottom: 20px;
    /*text-align: start; */
}
.fullTime, .student {
    text-align: center;
    margin-top: 5px;
    margin-bottom: 12px;
}
.fullTime>a>img, .student>a>img {
	margin-top: 15px;
	margin-bottom: 15px;
} 
.arrow {
	border: solid #378DBD; /*oasis #378DBD*/
	border-width: 0 3px 3px 0;
	display: inline-block;
	padding: 3px;
	margin: 0 0 3px 5px;
}
.right {
	transform: rotate(-45deg);
	-webkit-transform: rotate(-45deg);
}
</style>
<script>
function openForm() {
	document.getElementById("hearAboutUs").style.display = "block";
}
function closeForm() {
	document.getElementById("hearAboutUs").style.display = "none";
}
function showOtherText() {
	const x = document.getElementById("Other_text");
	const radios = document.querySelectorAll('input[name="heard_from"]');
	let selectedVal;
	for (const radiobutton of radios) {
		if (radiobutton.checked) {
			selectedVal = radiobutton.value;
			break;
		}
	}
	if (x.style.display == "block" && selectedVal !== "Other") {
		x.style.display = "none";
		document.getElementById("Other_text").required = false;
	} else if (x.style.display == "none" && selectedVal == "Other") {
		x.style.display = "inline";
		document.getElementById("Other_text").required = true;
	}
}
</script>
<script src="jquery.js"></script>
<html lang="en">
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T7QFBZH"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="container">
    <div class="row join">
        <div class="col">
            Join Our Team
        </div>
    </div>
    <div class="row">
        <div class="col fullTime">
            <a id="student_employment" onclick="ga('send', 'event', 'button', 'click', 'se');" href="./student.php" class="employmentHeader">STUDENT EMPLOYMENT<i class="arrow right"></i>
				<img class="img-fluid" src="./images/Main Page_Student Employemnt_1.jpg" width="100%" height="100%" />
			</a>
            <div class="employmentText">
                Be part of our diverse winning team and receive hands-on experience, while working in a fun and safe environment with a flexible schedule. We strive to coach, teach, and mentor all our students. 
            </div>
        </div>
        <div class="col student">
            <a href="./fulltime.php" class="employmentHeader">FULL-TIME EMPLOYMENT<i class="arrow right"></i>
            	<img class="img-fluid" src="./images/Main Page_Full-time Employment_2.jpg" width="100%" height="100%" />
			</a>
			<div class="employmentText">
                We want to help unlock your career potential! Beyond just a job, we offer opportunities for growth with an employer that strives to get you where you want. 
            </div>
        </div>
    </div>
</div>

<!-- three scripts for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<script>
//these two functions open and close the FT and student sections of page
function openStudent() {
	x = document.getElementById("studentEmp");
	if (x.style.display==="none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}
function openFT() {
x = document.getElementById("ftEmp");
	if (x.style.display==="none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}
</script>
<?php employment_finish() ?>