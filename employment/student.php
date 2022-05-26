<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--- META TAGS Start --->
    <meta name='keywords' content='student employee  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='employment for students  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student employment  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='work study  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='work study for employees  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='federal work study  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student employee  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='University of Arizona employment  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='UofA  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='UA Jobs  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='University of Arizona  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student jobs  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='jobs for students  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='jobs for students uofa  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='jobs for students university of Arizona  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student job Tucson  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='work study Tucson  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student employment Tucson  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='Tucson jobs  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='jobs Tucson  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student jobs Tucson Az  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='Az Tucson student jobs  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='student jobs near me  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='near me student work  '>
    <meta name='keywords' content=' '>
    <meta name='keywords' content='Student work  '>
    <!--- META TAGS End --->

</head>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
// require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/employment/template/employment.include.php');
$page_options['title'] = 'Student Opportunities';
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

    .join {
        /*arizona red #AB0520*/
        color: #AB0520;
        font-size: 64px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .employmentHeader {
        /*oasis*/
        color: #378DBD;
        font-size: 24px;
        font-weight: bold;
    }

    .employmentText {
        color: black;
        font-size: 18px;
        /*text-align: start; */
    }

    .fullTime,
    .student {
        text-align: center;
        margin-top: 5px;
    }

    #form-div {
        margin: auto;
    }

    .response-label {
        font-size: 22px;
        color: #378DBD;
        /*oasis #378DBD */
        font-family: "Proxima Nova" !important;
    }

    .imageLink {
        border: 1px solid blue;
    }

    .links {
        align-items: center;
        margin: auto;
        margin-bottom: 15px;
    }

    .joinTeam {
        color: #AB0520;
        /*arizona red #AB0520 */
        font-size: 32px;
        text-align: start;
        font-weight: bold;
        font-family: "Proxima Nova" !important;
        margin-bottom: 6px;
        width: 100%;
        text-transform: capitalize;
    }

    .joinTeamText {
        color: black;
        font-size: 20px;
        font-family: "Proxima Nova" !important;
        margin-bottom: 26px;
    }

    .howToApply,
    .workAndSchool,
    .acceptWorkStudy,
    .ourBenefits,
    .examplePositions {
        color: #378DBD;
        /*oasis #378DBD */
        font-size: 32px;
        text-align: start;
        font-weight: bold;
        font-family: "Proxima Nova" !important;
        margin-bottom: 6px;
        text-transform: capitalize;
    }

    .aalp,
    .hiringFAQ {
        color: #AB0520;
        /*arizona red #AB0520 */
        font-size: 32px;
        text-align: start;
        font-weight: bold;
        font-family: "Proxima Nova" !important;
        margin-bottom: 6px;
        text-transform: capitalize;
    }

    .howToApplyText,
    .workAndSchoolText,
    .acceptWorkStudyText,
    .ourBenefitsText,
    .examplePositionsText,
    .aalpText,
    .hiringFAQText {
        color: black;
        font-size: 20px;
        font-family: "Proxima Nova" !important;
        margin-bottom: 26px;
    }

    .examplePositionsImage,
    .examplePositionsText {
        margin-top: 15px;
        margin-bottom: 35px;
    }

    .examplePositionsText {
        margin-top: 25px !important;
    }

    .aalpContactText,
    .aalpContactText > a {
        color: #1E5288 !important; /* azurite blue #1E5288 */
    }

    .hiringFAQPrompt {
        font-style: italic;
        font-size: 24px !important;
        margin-bottom: 10px;
        
    }

    .expand {
        font-size: 24px;
        padding: 5px 5px 5px 5px;
        margin: 5px 5px 5px 5px;
        color: #0C234B !important; /* Arizona Blue #0C234B */
        font-weight: bold;
    }

    .expand:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    .hiddenAnswer {
        display: none;
        font-size: 24px !important;
    }

    /* .arrow and .down classes for arrow on FAQ questions */
    .arrow {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
        float: right;
    }

    .down {
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }

    p {
        font-size: 24px !important;
    }

    a.imageLink {
        font-size: 0 !important;
        text-decoration: none !important;
    }

    a {
        font-weight: bold;
        color: #AB0520;
        /*arizona red #AB0520 */
    }

    .links>div {
        margin-bottom: 20px;
    }
    .benefitsDiv {
        white-space: nowrap;
        margin-left: -20px;
    }
    .examplePositionsText>ul {
        margin-top: -30px;
    }
    .examplePositionsText>ul>li {
        line-height: 2.2;
    }
</style>
<script>

</script>
<script src="jquery.js"></script>
<html lang="en">

<body>
    <div class="container">
        <div class="row links">
            <div class="col-sm">
                <a href="https://arizona.joinhandshake.com/login" class="imageLink" target="_blank">
                    <img src="./images/Student Employment Page Buttons -01.png" alt="Open Positions" width="100%" height="100%">
                </a>
            </div>
            <div class="col-sm">
                <a href="#aalp" class="imageLink">
                    <img src="./images/Student Employment Page Buttons -02.png" alt="Leadership Program (AALP)" width="100%" height="100%">
                </a>
            </div>
            <div class="col-sm">
                <a href="#hiringFAQ" class="imageLink">
                    <img src="./images/Student Employment Page Buttons -03.png" alt="FAQ's" width="100%" height="100%">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="joinTeam">
                    JOIN THE ARIZONA STUDENT UNIONS' TEAM
                </div>
                <div class="joinTeamText">
                    Over 1,000 students work for the Arizona Student Unions each semester, making us the largest student employer on-campus. Be part of our diverse winning team and receive hands-on experience, while working in a fun and safe environment. We strive to coach, teach, and mentor all our students.
                    <br><br>
                    Studies prove that students with campus jobs tend to perform better in school, so get involved today! We have several different areas for students to work in, including: Culinary Services, Catering, Operations, Retail, Human Resources, Marketing, Administration, and Event Services.
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <div class="howToApply">
                    How to Apply for a Job
                </div>
                <div class="howToApplyText">
                    To apply, please visit
                    <a href="https://arizona.joinhandshake.com/login"  target="_blank">
                        Handshake
                    </a>
                    and search for 'AZ Student Unions'
                    <br><br>
                    If you have any questions, please feel free to email us at
                    <a href="mailto: su-unionshr@email.arizona.edu" target="_blank">
                        su-unionshr@email.arizona.edu
                    </a>
                    or call us at 520-626-9205.
                    <br><br>
                    <span style="font-style:italic; font-weight:bold;">
                        Before you apply:
                    </span>
                    <ul>
                        <li>Bring acceptable documentation as defined
                            <a href="https://union.arizona.edu/employment/accept-docs.pdf" target="_blank">
                                HERE.
                            </a>
                        </li>
                        <li>
                            Confirm that you are registered as a UArizona student with at least 6 units in order to qualify for Student Employment.
                        </li>
                        <li>
                            Confirm your class schedule and map out when you really have time to work so that you can fully commit to your school and work schedule.
                        </li>
                    </ul>

                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <div class="workAndSchool">
                    We Understand Juggling Work and School
                </div>
                <div class="workAndSchoolText">
                    At the Arizona Student Unions, we know that a student's priority is to learn. We understand the stress of midterms and final exams. We not only teach student employees leadership and time management, we are also very flexible when it comes to working around your class and exam schedule.
                    <br><br>
                    If you see three papers and a test coming in a few weeks, let your supervisor know as soon as you know, so that you can arrange something in advance, instead of waiting until the last minute!
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <div class="acceptWorkStudy">
                    We Accept Work Study
                </div>
                <div class="acceptWorkStudyText">
                    Federal Work Study is accepted at the Arizona Student Unions. The Federal Work Study Program provides opportunity to full-time students seeking part-time positions. Students must complete the FAFSA and demonstrate financial need for the respective year to receive Federal Work Study. For more information on Federal Work study, go to <a href="https://financialaid.arizona.edu/" >The Office of Scholarships and Financial Aid </a>.
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <div class="ourBenefits">
                    Check out our Benefits!
                </div>
                <div class="ourBenefitsText">
                    <div class="row">
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -04.png" />
                            <span>50% off meals</span>
                        </div>
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -08.png" />
                            <span>Meet new friends</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -05.png" />
                            <span>Work Study accepted</span>
                        </div>
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -09.png" />
                            <span>Work with other students</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -06.png" />
                            <span>Flexible hours</span>
                        </div>
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -10.png" />
                            <span>Convenience (we're on campus)</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -07.png" />
                            <span>Competitive wages</span>
                        </div>
                        <div class="col-sm benefitsDiv">
                            <img src="./images/Student Employment Page Buttons -11.png" />
                            <span>Opportunity for advancement</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <div class="examplePositions">
                    Example Student Positions
                </div>
                <div class="row">
                    <div class="col-sm examplePositionsImage">
                        <img class="img-fluid" src="./images/Student Workers.jpg" width="95%" height="95%" />
                    </div>
                    <div class="col-sm examplePositionsText">
                        <ul>
                            <li>&nbsp;Student Dining Services Attendant</li>
                            <li>&nbsp;Student Event Services Assistant</li>
                            <li>&nbsp;Student Dining Services Cashier</li>
                            <li>&nbsp;Student Office Assistant</li>
                            <li>&nbsp;Student Coordinator</li>
                            <li>&nbsp;Student Accounting</li>
                            <li>&nbsp;And Many More!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col" id="aalp">
                <div class="aalp" >
                    ARIZONA APPLIED LEADERSHIP PROGRAM (AALP)
                </div>
                <div class="aalpText">
                    The Arizona Applied Leadership Program is your first step to becoming a Lead in a unit within the Arizona Student Unions. The program seeks to provide a space for Student Leads to hone their craft and create a cohort of student leaders across the Arizona Student Unions who are trained on the best practices for impactful leadership. Student must be enrolled in the class to be promoted to a Student Lead position.
                    <br><br>
                    For more information on the Arizona Applied Leadership Program, please contact:<br>
                    <span class="aalpContactText">
                        AZ Student Unions<br>
                        Human Resources<br>
                        <a href="mailto: harrisoj@email.arizona.edu" target="_blank">
                            harrisoj@email.arizona.edu
                        </a>
                    </span>
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col" id="hiringFAQ">
                <div class="hiringFAQ">
                    APPLICATION AND HIRING FAQS
                </div>
                <div class="hiringFAQText">
                    <a name="top"></a>
                    <p class="hiringFAQPrompt">
                        Click on the questions to display the answers.
                    </p>
                    <div id="content">
                        <h2 class="expand">How many hours will I need to work? <i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <ul class="faq-ul">
                                <li>
                                    The hours you work per week depends on you. You decide how many hours you would like to work. When you apply you may be asked to provide the times you are available to work. Managers use this to schedule shifts and do take your class schedule into consideration when hiring and scheduling.
                                </li>
                                <li>
                                    If you are applying to a specific job, make sure you read it carefully as some managers request a preferred number of hours.
                                </li>
                                <li>
                                    As a Student Worker you may work up to 25 hours per week (20 for international students) during the Fall and Spring semester and up to 35 hours per week during summer session, winter session, and spring break.
                                </li>
                            </ul>
                            <!-- <p>
                        The hours you work per week depends on you. When you apply you are asked to fill in the times you would like to work. Managers use 
                        this to schedule shifts. The Unions always take your class schedule into consideration and realize you are a student first.
                        </p>
                        <p>
                        If you are applying to a specific job from our available jobs list, make sure you read it carefully as some managers request a 
                        preferred number of hours. As a student you can work anywhere from about 4 hours up to 30 hours a week (20 for international students).
                        </p> -->
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">How much will I get paid?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                This depends primarily on where you work. Most of our jobs are paid minimum wage. Some of our more qualified positions start at a higher pay. Please refer to the description or contact the supervisor for further questions.
                                <!-- This depends primarily on where you work. Most of our jobs start at $11 an hour, or minimum wage. Some of our more qualified 
                        positions start at a higher pay. If you are applying for an internship please check with the listed supervisor to discuss 
                        compensation. As a student you can hear both merit raises and raises based on high evaluation scores.  -->
                                <!-- The current pay ranges for students based on area are:-->
                            </p>
                            <!-- <ul style="list-style-type: none; line-height: 1.5em;">
                            <li>Dining Services: $7.65 - $11 per hour</li>
                            <li>Center for Student Involvement and Leadership: $7.65 - $9.25 per hour</li>
                            <li>Marketing/Admin: $7.65 - $11 per hour</li>
                            <li>Operations: $ 7.65 - $11 per hour</li>
                        </ul> -->
                            <p>
                                Internships may be paid or unpaid. Please refer to the description or contact the supervisor for further questions
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What if I have work study/financial aid?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <ul class="faq-ul">
                                <li>
                                    If you have completed your FAFSA and received your financial award letter stating you have qualified for Federal Work-Study, you are considered "work-study eligible". This means you can apply for both off campus and on campus jobs that accept work-study. The Arizona Student Union welcomes any work-study eligible student to apply, as all of our units accept Federal Work-Study.
                                </li>
                                <li>
                                    To check to see if you are work-study eligible or to find out more information about work study please visit the Financial Aid Office or go to their website at https://financialaid.arizona.edu/types-of-aid/fws
                                </li>
                                <li>
                                    If you were offered Federal Work-Study for the academic year, in August the Office of Scholarships & Financial Aid will send you an email with your Federal Work-Study Authorization Form and information on how to activate your award.
                                </li>
                            </ul>
                            <!-- <p>
                        If you have completed your FAFSA and received your financial award letter stating you have qualified for work study, you are considered 
                        "work study eligible". This means you can apply for both off campus and on campus jobs that accept work study. The Arizona Student Unions 
                        welcomes any work study eligible student to apply, as all jobs at the Union accept Federal Work Study. If you do not have work study 
                        you can still apply, but be aware that a few positions, such as in the Center for Student Involvement and Leadership, require work study. 
                        You can check if you are work study on Student Link. During the first week of August forms will become available to you on student link 
                        to give to your employer.
                        </p>
                        <p>
                        To find out more information about work study please visit the Financial Aid Office or go to their website 
                        <a href="https://financialaid.arizona.edu/Workstudy/">here</a>
                        </p> -->
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">I don't want to work with food; can I still get a job at the Union?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                We employ anywhere from 800-1000 students during the Fall and Spring semesters. There are three main areas where you can work: Dining Services, Operations, and Retail/Administration. We have jobs ranging from dining services attendants to desk jobs and jobs in operations. Although 75% of our student jobs fall under Dining Services, there are a number of other opportunities in the Student Union.
                                <!-- The Arizona Student Unions employs anywhere from 800- 1000 students during Fall and Spring semester. There are four main areas where you 
                        can work: Dining Services, Operations, Retail/Admin, and the Center for Student Involvement and Leadership. We have jobs ranging from dining 
                        services attendants to desk jobs and internships. Although 75% of our student jobs fall under Dining Services, there are a number of other 
                        opportunities in the Union. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What can I apply for?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                You are able to apply to any and all available jobs at the Student Union. Each job is unique. The Student Union has 40+ units that hire students. The number and type of jobs varies during the year. We have several options for employment and jobs for every interest.
                                <!-- You are able to able for jobs through our <a href="/employment/application/start.php">online application</a> page. The Union's “Get a JOB” 
                        online application has several options when applying. You are able to apply to any and all available jobs. Your application will be sent out 
                        to all managers. You may also apply for specific Union departments. The Unions has four main areas: Dining Services, Operations, Retail/Admin, 
                        and the Center for Student Involvement and Leadership. There are different benefits to working in each area. You may also apply for specific 
                        jobs or units. The Unions has 42 units that hire students. The amount of units and specific jobs varies during the year. There are also various 
                        internships offered throughout the year. The Union has several options for employment and jobs for every interest. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What if I've never had a job before?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                We welcome every type of student to apply. If you have no previous work experience the Student Union is a good place to start as we provide on-the-job training. We offer a convenient on campus location and flexible scheduling. It's a great resume builder too!
                                <!-- The Student Unions welcomes every type of student to apply. If you have no previous work experience the Union is a good place to start. We offer 
                        a convenient on campus location and flexible scheduling. It's a great resume builder too! -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Is it a good idea for freshman to work?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Working for the Student Union is a great way to get involved and to get to know your campus and peers. Studies prove that students who are involved on campus do better in school, and the Student Union is the perfect place to get involved! Working is a great chance to gain valuable skills, meet wonderful people, and make a little money too.
                                <!-- Working for the Unions is a great way to get involved and get to know your campus and peers. Studies prove that students who are involved on campus 
                        do better in school, and the Union is the perfect place to get involved! Working is a great chance to gain valuable skills, meet wonderful people, 
                        and make a little money too. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Where can I find available jobs?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                To check current job openings please visit <a href="http://arizona.joinhandshake.com/" target="_blank">Handshake</a>, the job board and career development platform for University of Arizona students, and search for ‘AZ Student Unions’. There you will find jobs in many different areas and will be able to read job descriptions and qualifications of all the units currently hiring. This information is updated regularly, so if you don't see something you like now, check back again in a few days or weeks.
                            </p>
                            <!-- <p>
                        To check current job openings please visit out <a href="available.php">Available Jobs</a>  page to read job descriptions and qualifications of all 
                        the units currently hiring. This is updated regularly, so if you don't see something you like now, check back again in a few days or weeks.
                        </p>
                        <p>
                        You can also search for Student Unions jobs on the Wildcat Joblink, a job posting site for the University of Arizona. This can be found on the career 
                        services website <a href="http://www.career.arizona.edu">www.career.arizona.edu</a>. You can search Student Union jobs by looking searching "Student 
                        Union Services" under the job function search field. It is also a good idea to apply to more than one place. Check out all on campus jobs.
                        </p> -->
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What if I don't have a Net ID?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Handshake is the job board and career development platform for University of Arizona students and graduates. If you are a current, degree-seeking U of A student or a recent graduate from the past year, use your Net ID to create and log into our application.
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Can I apply if I don't know my schedule?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Yes you can, but it may be easier to wait until you have a general idea of your availability. You are welcome to either reach out to the contact person identified in the posting or to our Student Unions Human Resources office for assistance. They can be reached at 520-626-9205 or at <a href="mailto:su-unionshr@email.arizona.edu" target="_blank">su-unionshr@email.arizona.edu</a>.
                                <!-- We recommend waiting to apply until you know the hours and times you would like to work. It is hard to fill out the scheduling tool on our application 
                        if you don't know your class schedule. The Union's application allows you to mark the hours that you want to work, so it's best to be prepared. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What if my schedule has changed since I applied?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                If you have already applied and your schedule changes at any time, you can log back into your Handshake account and edit your existing application.
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Once I apply, when will I be contacted?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Depending on where you applied to, the time it takes for you to be contacted may vary. Please be patient as our managers are very busy. If you are extremely interested in a certain position, feel free to contact the manager at that unit and give them your name and contact information, You are also welcome to reach out to our Student Unions Human Resources office for assistance. They can be reached at 520-626-9205 or at <a href="mailto:su-unionshr@email.arizona.edu" target="_blank">su-unionshr@email.arizona.edu</a>.
                                <!-- The Unions have around 40 units that hire students, and even more if you include our internship sites. Depending on where you applied to, the time 
                        it takes for you to be contacted may vary. Please be patient as our managers are very busy. If you are extremely interested in a certain position, 
                        feel free to contact the manager at that unit and give them your name and contact information. This could increase your chances of gaining employment 
                        in that specific area. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Do you have summer employment?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Due to summer closures, the Arizona Student Unions does not actively seek students for summer employment. You can however apply for the Fall Semester during the summer and apply for the Spring Semester during the fall.
                                <!-- Due to summer closures, the Arizona Student Unions does not actively seek students for summer employment. You can however apply for the fall semester 
                        over summer and apply for the spring semester during the fall. When you apply make sure you check the right semester in the application. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">When can I start work?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                If you are an incoming freshman, per University policy, you can start work 1 week prior to the first day of school. Your actual start date is determined by your hiring supervisor. You will need to fill out a hiring packet once you are offered a position. After the paperwork is processed, then you may begin work.
                                <!-- If you are an incoming freshman please be aware you can only start work 2 weeks prior to the first day of school. -->
                            </p>
                            <!-- <p>
                        Your start date is determined by your hiring supervisor. You will need to fill out a hiring packet once offered a position. After this is processed, then 
                        you may begin work.
                        </p> -->
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What if I am an international student?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                If you have questions regarding international student employment please visit the International Student Programs and Services Office or their website at <a href="http://internationalstudents.arizona.edu/home" target="_blank">http://internationalstudents.arizona.edu/home</a>
                                <!-- If you have questions regarding international student employment please visit the International Student Programs and Services Office or their website 
                        at <a href="http://internationalstudents.arizona.edu/home">http://internationalstudents.arizona.edu/home</a> -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Are there opportunities for advancement?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                Yes, there are ways to advance in the Student Union. You can become a student lead in your area, which provides you more responsibility. These positions are filled based on experience and high evaluation scores and completion of the Arizona Applied Leadership Program. As a student you may also move around to different areas, which is a unique feature to the Arizona Student Unions.
                                <!-- There are several ways to advance in the Student Union. You can become a student lead in your area, which provides you more responsibility. 
                        These positions are filled by experience and high evaluation scores. We also have a Professional Internship Program (PIP) which trains students 
                        to become managers within in their area. To learn more about this opportunity visit the PIP informational page <a href="/about/student_hr/pip.php">here</a>. 
                        As a student you may also move around to different areas, which is a unique feature to the Arizona Student Unions. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">Who can I talk to if I have questions about the application process or Hiring?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                You can reach out to our Student Human Resources at the Unions at <a href="mailto:su-unionshr@email.arizona.edu" target="_blank">su-unionshr@email.arizona.edu</a>. You may contact their office by email with any question you have or by phone at (520) 626-9205.
                                <!-- Student Human Resources is a student run group that seeks to better employment for student employees at the
                        Unions at http://www.union.arizona.edu/about/student_hr/. You may contact SHR with any question you have by
                        email <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a> or phone (520) 626-9205 -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>

                        <h2 class="expand">What documents do I need to bring if I am hired?<i class="arrow down"></i></h2>
                        <div class="hiddenAnswer">
                            <p>
                                A list of acceptable documentation can be found <a href="accept-docs.pdf" target="_blank">HERE</a>.
                                <!-- For a list of acceptable documentation, go to the Department of Homeland Security website at <a href="https://www.uscis.gov/i-9-central/acceptable-documents" target="_blank" >https://www.uscis.gov/i-9-central/acceptable-documents</a>. -->
                                <!-- A list of acceptable documentation can be found <a href="accept-docs.pdf">here</a>. -->
                            </p>
                            <p class="top">
                                <a href="#top" style="color: #C00;">&#9650; TOP</a>
                            </p>
                            <br class="clear" />
                            <hr />
                            <br />
                        </div>
                    </div>
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
    document.querySelectorAll(".expand").forEach(element => {
        element.addEventListener("click", event => {
            let hiddenAnswer = element.nextElementSibling;
            if (hiddenAnswer.style.display != "block") {
                hiddenAnswer.style.display = "block";
            } else {
                hiddenAnswer.style.display = "none";
            }
        })
    })

    // change banner image without affecting global.inc
    let banner = document.getElementsByClassName("wrap-banner-img");
    let img = document.createElement('img');
    img.src = './images/student_Employment_Header.jpg';
    banner[0].appendChild(img);
</script>
<?php employment_finish() ?>