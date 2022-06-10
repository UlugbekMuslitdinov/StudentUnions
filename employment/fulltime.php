<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--- META TAGS Start ---->
    <meta name='keywords' content='Tucson Az jobs'>
    <meta name='keywords' content='Tucson Az full time'>
    <meta name='keywords' content='Tucson Az employment'>
    <meta name='keywords' content='Tucson Az full-time employment'>
    <meta name='keywords' content='University of Arizona full time'>
    <meta name='keywords' content='University of Arizona full time employment'>
    <meta name='keywords' content='UofA full time'>
    <meta name='keywords' content='UofA full time employment'>
    <meta name='keywords' content='UofA employment'>
    <meta name='keywords' content='UofA jobs'>
    <meta name='keywords' content='full time UofA'>
    <meta name='keywords' content='full time university of Arizona'>
    <meta name='keywords' content='full time uofa employment'>
    <meta name='keywords' content='jobs Tucson'>
    <meta name='keywords' content='full time jobs'>
    <meta name='keywords' content='full time jobs near me'>
    <meta name='keywords' content='full time near me'>
    <meta name='keywords' content='UofA jobs near me'>
    <meta name='keywords' content='full time employment near me'>
    <meta name='keywords' content='near me full time'>
    <meta name='keywords' content='Az Tucson full time employment'>
    <meta name='keywords' content='Tucson Az full time employment near me'>
    <meta name='keywords' content='University jobs'>
    <meta name='keywords' content='jobs at uofa'>
    <meta name='keywords' content='Tucson jobs'>
    <meta name='keywords' content='Career'>
    <meta name='keywords' content='Full time career'>
    <meta name='keywords' content='Recruitment'>
    <meta name='keywords' content='Hiring'>
    <meta name='keywords' content='Hire'>
    <meta name='keywords' content='Jobs hiring'>
    <meta name='keywords' content='Apply for job'>
    <meta name='keywords' content='Jobs in Arizona'>
    <meta name='keywords' content='Hospitality jobs'>
    <meta name='keywords' content='Looking for jobs'>
    <meta name='keywords' content='Back of the house jobs'>
    <meta name='keywords' content='Cook jobs'>
    <meta name='keywords' content='Food service jobs'>
    <meta name='keywords' content='Full time work'>
    <meta name='keywords' content='Part time work'>
    <meta name='keywords' content='Job vacancies'>
    <meta name='keywords' content='Job openings'>
    <!--- META TAGS End ---->

</head>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
// require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/employment/template/employment.include.php');
$page_options['title'] = 'Full Time Opportunities';
$page_options['head'] = '';
$page_options['page'] = 'Student Job Application';
// $page_options['header_image'] = '/template/images/banners/student_employment.png';
// $page_options['header_image'] = '/template/images/banners/employment_unions_banner.jpg';
employment_start($page_options);
session_start();
?>

<style>
    body {
        font-family: "Proxima Nova" !important;
    }

    *,
    *::after,
    *::before {
        box-sizing: border-box;
    }

    .modal {
        font-family: "Proxima Nova" !important;
    }

    .modal-dialog {
        top: 250px;
        height: 309px;
        min-width: 40vw;
        max-width: 500px;
        margin: auto;
        text-align: start;
    }

    .modal-header {
        padding: 10px 0px;
        align-items: center;
        border-style: solid;
        /*border-bottom: 1px solid black;*/
    }

    .modal-body {
        margin: auto;
    }

    .modal-content {
        margin: auto;
    }

    .modal-img {
        position: relative;
        width: 309px;
        height: 400px;
        align-self: stretch;

    }

    input[type="submit"] {
        background: url(./images/submit.png) no-repeat;

        width: 130px;
        height: 40px;
        border: none;
        color: transparent;
        font-size: 0;
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat the image */
        background-size: cover;
    }

    .btn-secondary,
    .button-submit {
        position: relative;
        left: 20px;
        top: 10px;
        margin: 10 auto;
        margin-bottom: 15px;
        padding: 10px 10px 10px 10px;
        display: table-cell;
        vertical-align: middle;
        font-size: 20px;
        font-weight: bold;
    }

    .p-header {
        color: #AB0520;
        /*arizona red #AB0520*/
        font-weight: bold;
        font-size: 36px;
        font-family: "Proxima Nova" !important;
        text-align: center;
    }

    input[type="radio"] {
        margin: 10px;
    }

    #form-div {
        margin: auto;
    }

    .response-label {
        color: #378DBD;
        /*oasis #378DBD */
        font-family: "Proxima Nova" !important;
        font-size: 24px;
        font-weight: bold;
        white-space: nowrap;
    }

    .imageLink {
        border: 1px solid blue;
    }

    .links {
        align-items: center;

        margin-bottom: 15px;
    }

    .link {
        margin: 7px;
    }

    .workWithUs {
        color: #517C8E;
        /*azurite blue #517C8E*/
        /*arizona red #AB0520*/
        text-transform: uppercase;
        font-size: 32px;
        text-align: start;
        font-weight: bold;
        font-family: "Proxima Nova" !important;
        margin-bottom: 6px;
    }

    .workWithUsText {
        color: black;
        font-size: 18px;
        font-family: "Proxima Nova" !important;
        margin-bottom: 26px;
    }

    .howToApply,
    .careerOpenings,
    .gotYouCovered {
        color: #517C8E;
        /*azurite blue #517C8E*/
        /*oasis #378DBD */
        text-transform: uppercase;
        font-size: 32px;
        text-align: start;
        font-weight: bold;
        font-family: "Proxima Nova" !important;
        margin-bottom: 6px;
    }

    .howToApplyText,
    .careerOpeningsText,
    .gotYouCoveredText {
        color: black;
        font-size: 18px;
        font-family: "Proxima Nova" !important;
        margin-bottom: 26px;
    }

    .careerOpeningsRow {
        margin-bottom: 10px;
        align-items: end;
    }

    .card {
        margin-bottom: 10px;
        background-color: #E2E9EB;
    }

    .card-body {
        align-self: center;
        text-align: center;
        height: 120px;
        padding: 20px 0 0 0;
        font-weight: bold;
    }

    .card-img-top {
        object-fit: scale-down;
    }

    a.imageLink {
        font-size: 0 !important;
        text-decoration: none !important;
    }

    .talentLink,
    .benefitsLink {
        color: #AB0520;
        /*arizona red #AB0520*/
        font-weight: bold;
    }

    .clickPostings {
        font-style: italic;
        color: black;
        font-size: 18px;
        font-family: "Proxima Nova" !important;
        font-weight: 400 !important;
    }

    .table-borderless>tbody>tr {
        display: inline-flex;
    }

    .table-borderless>tbody>tr>td {
        width: 50%;
    }

    .imgDiv {
        margin-left: -80px;
        margin-right: 20px;
        margin-bottom: 0;
        margin-top: -10px;
        padding-left:20px;
    }
    .weightImgDiv {
        margin-top: -20px;
    }
    .tableDiv {
        margin-left: 25px;
    }

    .table-borderless>tbody>tr>td>div>div {
        text-align: left;
        width: 110%;
        font-size: 18px;
        font-family: "Proxima Nova" !important;
    }

    .tableDiv >h4 {
        font-weight: bold;
        margin-top: 20px;
    }

    .offersList>li {
        list-style-type: circle;
    }

    .servicesAttendantsText {
        margin-top: -20px;
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
                //break;
            }
        }
        if (x.style.display == "inline" && selectedVal !== "Other") {
            x.style.display = "none";
            document.getElementById("Other_text").required = false;
        } else if (x.style.display == "none" && selectedVal == "Other") {
            x.style.display = "inline";
            document.getElementById("Other_text").required = true;
        }
    }

    function submitForm() {
        document.getElementById("responseForm").submit();
    }
    $("#prospects_form").submit(function(e) {
        e.preventDefault(); // <==stop page refresh==>
    });
    var form = document.getElementById("responseForm");

    function handleForm(event) {
        event.preventDefault();
    }
    form.addEventListener('submit', handleForm);
</script>
<script src="jquery.js"></script>
<html lang="en">
<!-- <body onClick="popup('./popup.php', 'test'); this.onclick=null;"> -->
<?php
if ((isset($_GET['redirect'])) && ($_GET['redirect'] = "yes")) {
    // Don't disply the popup survey.  This is the second time loading.
?>

    <body>
    <?php } else { // Disply the popup survey. 
    ?>

        <body onload="$('#responseModal').modal('show');">
        <?php } ?>
        <!-- modal -->
        <div class="modal fade container" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true" style="max-width:100%; max-height:100%;">
            <div class="modal-dialog col" role="document">
                <div class="modal-content">
                    <!--<div class="modal-header">
				<h1 class="h1-header">HOW DID YOU HEAR ABOUT US?</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> 
			</div> -->
                    <!-- <img id="modal" class="modal-img" src="./images/cook_reduced.jpg" alt="cooks" style="max-width:30vw; max-height:40vw;"> -->
                    <div id="form-div">
                        <form id="responseForm" method="POST">
                            <div class="modal-body">
                                <p class="p-header" style="max-width:100vw;">HOW DID YOU HEAR ABOUT US?</p>
                                <br />

                                <input type="radio" id="Indeed.com Ad" name="heard_from" value="Indeed.com Ad" onChange="showOtherText()" required>
                                <label class="response-label" for="Indeed.com Ad">Indeed.com Ad</label><br />

                                <input type="radio" id="YouTube Ad" name="heard_from" value="YouTube Ad" onChange="showOtherText()" required>
                                <label class="response-label" for="YouTube Ad">YouTube Ad</label><br />

                                <input type="radio" id="Social Media Ad" name="heard_from" value="Social Media Ad" onChange="showOtherText()">
                                <label class="response-label" for="Social Media Ad">Social Media Ad</label><br />

                                <input type="radio" id="Job Fair" name="heard_from" value="Job Fair" onChange="showOtherText()">
                                <label class="response-label" for="Job Fair">Job Fair</label><br />

                                <input type="radio" id="Referred by Friend" name="heard_from" value="Referred by Friend" onChange="showOtherText()">
                                <label class="response-label" for="Referred by Friend">Referred by Friend</label><br />

                                <input type="radio" id="Other" name="heard_from" value="Other" onChange="showOtherText()">
                                <label class="response-label" for="Other" class="other_label">Other <span>(Please specify where?)</span>&nbsp;</label><input type="text" class="Other" id="Other_text" name="Other_text" style="display:none" /><br />

                                <input type="submit" onCLick="submitForm();" name="submit" value="Submit" class="button-submit">
                            </div>
                            <!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" onClick="submitForm()" name="submit" value="Submit" class="button-submit">
				<button type="button" onClick="submitForm();"> submit </button> 
			</div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->

        <div class="container">
            <div class="row links">
                <div class="col-sm link">
                    <a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=union" class="imageLink" target="_blank"><img src="./images/Open Positions Button.png" alt="Open Positions" width="100%" height="100%" /></a>
                </div>
                <div class="col-sm link">
                    <a href="https://talent.arizona.edu/applicant-resources" class="imageLink" target="_blank"><img src="./images/Applicant Resources button.png" alt="Applicant Resources" width="100%" height="100%" /></a>
                </div>
                <div class="col-sm link">
                    <a href="#gotYouCovered" class="imageLink"><img src="./images/Employee Benefits Buttons-03.png" alt="Employee Benefits" width="100%" height="100%" /></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="workWithUs">
                        Come Work With Us
                    </div>
                    <div class="workWithUsText">
                        Join our team at the Arizona Student Unions, considered the kitchen and living room of the University of Arizona, where everyone can eat, play, relax, and get involved! Here you will find more than 30 restaurants, the Arizona Catering & Events Co., Rooftop Greenhouse, Esports Arena and more. We provide a "home away from home" to balance the diverse educational, recreational, cultural, and social needs of today's student.
                        <br><br>
                        We want to help unlock your career potential! Beyond just a job, we offer opportunities for growth with an employer that strives to get you where you want.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="howToApply">
                        How To Apply
                    </div>
                    <div class="howToApplyText">
                        To view all open UArizona Student Union job openings visit
                        <a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=union" class="talentLink" target="_blank">
                            Talent, our applicant portal.
                        </a>
                        <br><br>
                        For more information on how to submit your application using the University of Arizona's online applicant portal please review the
                        <a href="https://union.arizona.edu/about/template/resources/TalentApplicantGuide.pdf" class="talentLink" target="_blank">
                            Talent Applicant Guide
                        </a>
                        or the 
                        <a href="https://www.youtube.com/watch?v=s6BFHxGevPs" class="talentLink" target="_blank">
                            How to Apply video.
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="careerOpenings">
                        Career Openings
                        <div class="clickPostings">Click postings below to apply.</div>
                    </div>
                    <div class="careerOpeningsText">
                        <div class="row careerOpeningsRow">

<!--                            // Get all records from the table career_openings-->
                            <?php
                            // Database connection
                            require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
                            $db = new db_mysqli('su');
                            $sql = "SELECT * FROM career_openings ORDER BY position";
                            $result = $db->query($sql);

                            // Loop through the records and display them
                            while ($row = $result->fetch_assoc()) {
                                if ($row['retired'] == "No"){
                                    echo '<div class="col-sm-3">';
                                    $position = $row['position'];
                                    echo '<div class="card" onClick="employmentLink('. "'" . $position . "'" .')">';
                                        echo '<img class="card-img-top" src="'. "/employment/images/career_openings/" . $row["image_file"]. '" alt=' . $row["position"] . '>';
                                            echo '<div class="card-body">';
                                                echo '<div class="card-body">';
                                                    // Uppercase position
                                                    echo strtoupper($row["position"]);
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            }
                            //
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col" id="gotYouCovered">
                    <div class="gotYouCovered" onClick="goToBenefits()">
                        We've Got You Covered
                    </div>
                    <div class="gotYouCoveredText">
                        <span style="font-style:italic;">
                            The University provides outstanding benefits including:
                        </span><br />
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Qualified Tuition_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Qualified Tuition Reduction</h4>
                                            <span>
                                                Save at least 75% in tuition cost for Undergraduate studies. Available to you and eligible family members for University of Arizona, Arizona State University, or Northern Arizona University. Take undergraduate and graduate courses in-person or online.
                                            </span>
                                        </div>
                                    </div>
                                </div>&emsp;&nbsp;&nbsp;
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Medical Insurance_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Medical, Dental, and Vision</h4>
                                            <span>
                                                The University of Arizona pays 88% of your health benefit cost. Coverage for domestic partners and their families is also available. Pick from multiple medical and dental options.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><br/>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Retirement Plan_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Retirement Plans</h4>
                                            <span>
                                                Contributions are made by the University of Arizona. No-cost financial counseling is available with TIAA and Fidelity Investments. Health insurance options are available for University of Arizona retirees.
                                            </span>
                                        </div>
                                    </div>
                                </div>&emsp;&nbsp;&nbsp;
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Accrurals and Vacay_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Accruals and Holidays</h4>
                                            <span>
                                                The University offers generous paid vacation, sick leave, and paid holidays.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><br/>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Disability_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Disability and Life Insurance Programs</h4>
                                            <span>
                                                Up to $15,000 of term life insurance provided at no cost. Elect up to $1 million in additional life insurance. Short-term and long-term disability coverage is available.
                                            </span>
                                        </div>
                                    </div>
                                </div>&emsp;&nbsp;&nbsp;
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Discounts_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Discounts</h4>
                                            <span>
                                                Take advantage of reduced prices with local transit services, including SunTran and the SunLink Streetcar.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><br/>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv">
                                            <img src="./images/Employee Referral_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>Employee Referral Program</h4>
                                            <span>
                                                As an employee, you can refer a friend to any open positions at the Student Unions for a chance to win big prizes.
                                            </span>
                                        </div>
                                    </div>
                                </div>&emsp;&nbsp;&nbsp;
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-2 imgDiv weightImgDiv">
                                            <img src="./images/University Resources_Weve got you covered.png" />
                                        </div>
                                        <div class="col-10 tableDiv">
                                            <h4>University Resources</h4>
                                            <span>
                                                In addition, the University offers access to UArizona recreations and cultural activities, wellness programming, employee assistance programs, career advising, adult and eldercare support and free health screenings.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br/>
                        For more information please visit the university's
                        <a href="https://talent.arizona.edu/compensation-and-benefits" class="benefitsLink" target="_blank">
                            Compensation and Benefits
                        </a>
                        page.
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
    /* this employmentLink function sends user to link on click of card. Links supplied by marketing team. */
    function employmentLink(position) {
        switch (position) {
            case 'Banquet Servers':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home/requisition/7178?c=arizona";
                break;
            case 'Banquet Captains':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home/requisition/8705?c=arizona";
                break;
            case 'Catering Managers':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home/requisition/8703?c=arizona";
                break;
            case 'Cooks':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=cooks";
                break;
            case 'Administrative Support':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home/requisition/8661?c=arizona";
                break;
            case 'Events Management':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home/requisition/6989?c=arizona";
                break;
            case 'Dining Services Attendants':
                url = "https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=culinary%20and%20food%20service%20attendant";
                break;
        }
        window.location.href = url;
    }
    /*this goToBenefits function sends user to benefits page. Link from marketing team. */
    function goToBenefits() {
        window.location.href = "https://talent.arizona.edu/compensation-and-benefits";
    }
    /*for cursor change, to show cards and link section are clickable*/
    document.querySelectorAll(".card").forEach(element => {
        element.addEventListener("mouseover", event => {
            document.body.style.cursor = "pointer";
        })
        element.addEventListener("mouseout", event => {
            document.body.style.cursor = "default";
        })
    })
    document.querySelector(".gotYouCovered").addEventListener("mouseover", event => {
        document.body.style.cursor = "pointer";
    })
    document.querySelector(".gotYouCovered").addEventListener("mouseout", event => {
        document.body.style.cursor = "default";
    })
    // change banner image without affecting global.inc
    let banner = document.getElementsByClassName("wrap-banner-img");
    let img = document.createElement('img');
    img.src = './images/fulltime_Employment_Header.jpg';
    banner[0].appendChild(img);
</script>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['submit'])) {
    //start email//
    //header('Content-Type: text/html');
    $to = "baas-mkt@arizona.edu";   	//receiver
    // $to = "su-web@email.arizona.edu";       //receiver
    $from = "baas-mkt@email.arizona.edu";     //sender
    // To send HTML mail, the Content-type header must be set
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . "baas-mkt@email.arizona.edu" . "\r\n";
    $headers .= "CC: baas-mkt@email.arizona.edu\r\n"; 
    $headers .= "BCC: riccypartida@arizona.edu\r\n"; 
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $subject = "Student Unions Employment - How Did You Hear About Us? Response";
    //$subject2 = "subject2";  		//can set extra subjects if sending emails to different people/organizations
    $msg = "<html><body><h2 style='color:#ac051f; font-weight:bold;'>     Hello,<br/><br/>A response has been received from \"<u>How Did You Hear About Us?</u>\" pop-up form of the Student Union Employment Opportunities site.</h2>\n";
    $msg .= "<h4> The response is:</h4>    <h3>" . $_POST['heard_from'] . "</h3>";
    //check if the response of 'heard_from' is 'Other', and add user entered text to $msg
    if ($_POST['Other_text']) {
        $msg .= "<h4>user typed entry:</h4> <h3>" . $_POST['Other_text'] . "</h3>";
    }
    $msg .= "</body></html>";
    //store the popup information into the database//
    $db = new db_mysqli('su');
    $query = "INSERT INTO employment SET " .
        "response = '" . $_POST['heard_from'] .
        "', other = '" . $_POST['Other_text'] .
        "'";
    $db->query($query);
    //send email//
    $email = mail($to, $subject, $msg, $headers);
    if ($email) {
        print_r('<script type="text/javascript">alert("Email sent! Thank you for your response!\n");window.location.href="fulltime.php?redirect=yes";</script>');
    } else {
        print_r('<script type="text/javascript">alert("There was a problem sending your response. Please close the window and refresh the employment page to try again.");window.close();</script>');
    }
}
?>

<?php employment_finish() ?>