<?php
/*
 * Corporate Sponsors
 * Created September, 2009
 */
 
if (!defined('ACCESS'))
{
	die('Hacking Attempt');
}
//require_once('db.inc');
require_once ('includes/mysqli.inc');
// Database
$db = new db('corporatesponsors');

// Authentication list
$admin = array('styx', 'sanorris', 'kmbeyer', 'harrisoj', 'mattsona', 'mpl', 'bphinney');

//
// Functions
//

// Authenticate
function start_webauth($auth)
{
	// Start session
	session_start();

	// Authenticate with WebAuth
	require_once('webauth/include.php');

	// Authentication list
	if (!in_array($_SESSION['webauth']['netID'], $auth))
	{
		session_destroy();
		die('You are not authorized to access this page.');
	}
}

// General config
function get_config()
{
	global $db;
	$query = "SELECT * FROM csil_club_config";
	
	$result = $db->query($query);
	//while ($row = mysql_fetch_assoc($result))
	while ($row =  $result->fetch_array()) {
	{
		$config[$row['config_name']] = stripslashes($row['config_value']);
	}

	return $config;
}

// Budget config
function get_budget($year)
{
	global $db;	
	$query = "SELECT * FROM csil_club_budget WHERE year = " . intval($year);
	$result = $db->query($query);
	//$row = mysql_fetch_assoc($result);
	$row =  $result->fetch_array();

	return $row;
}

// Sanitize for queries
function clean_string($string, $pattern = '')
{
	
	$string = str_replace("\'", "''", trim($string));
	$string = ($pattern != '') ? eregi_replace($pattern, '', $string) : $string;

	return $string;
}

// Parse variables in content
function parse_vars($vars, $content)
{
	$keys = explode(' ', '{' . implode(array_keys($vars), '} {') . '}');
	return str_replace($keys, $vars, $content);
}

// Decides if year needs to be pushed up one for FY
function push_fiscal($time)
{
	return ($time > mktime(0, 0, 0, 7, 1, date('y')) && $time < mktime(0, 0, 0, 12, 31, date('y'))) ? date('Y', $time) + 1 : date('Y', $time);
}

// Dump first prep row in budget
function budget_first($array)
{
	unset($array[0]);
	return (is_array($array)) ? array_values($array) : false;
}

// Approval status with color
function status_color($status)
{
	global $approvals;
	$color = ($status > -1) ? ($status == 0) ? 'red' : (($status == 1) ? 'green' : (($status == 2) ? 'orange' : 'blue')) : '';
	return '<span style="color: ' . $color . '">' . (($status < 0) ? 'N/A' : $approvals[$status]) . '</span>';
}

// File extension
function ext($file)
{
	return strtolower(substr(strrchr($file, '.'), 1));
}

//
// General initialization
//
$config = get_config();
$sorts = array('asc', 'desc');
$orders = array('date', 'organization', 'name', 'request_amount', 'request_approved', 'approved');
$approvals = array('Denied', 'Approved', 'Partially Approved', 'Not Used');

// Initialize
$page = (preg_match("#^[a-z0-9_-]+$#is", $_GET['p'])) ? $_GET['p'] : '';
$id = (isset($_POST['id'])) ? intval($_POST['id']) : intval($_GET['id']);
$year = (isset($_GET['y'])) ? intval($_GET['y']) : push_fiscal(time());
$sort = (isset($_POST['s'])) ? (@in_array($_POST['s'], $sorts) ? $_POST['s'] : 'desc') : (@in_array($_GET['s'], $sorts) ? $_GET['s'] : 'desc');
$order = (isset($_POST['o'])) ? (@in_array($_POST['o'], $orders) ? $_POST['o'] : 'date') : (@in_array($_GET['o'], $orders) ? $_GET['o'] : 'date');

// Criterias
$criterias = array(
	array(
    	'name' => 'Collaborative Program',
		'description' => 'Sponsoring organization&rsquo;s event/program is co-sponsored by at least one other recognized student organization or campus department/unit/college and are working together to bring a program to the larger campus population. (Collaboration must include at least one of the following: financial support, in-kind donations, donated time and/or services).'
	),
	array(
    	'name' => 'Program/event is open and free to all campus constituents'
	),
	array(
    	'name' => 'Promotes healthy lifestyle</strong>',
		'description' => 'The event supports, encourages, or provides an opportunity for students to choose behaviors and environments that promote health and reduce risky behavior; articulates the relationship between health and wellness and accomplishing life long goals; or encourages students to exhibit behaviors that advance a healthy community.'
	),
	array(
    	'name' => 'Promotes social justice',
		'description' => 'The event is designed to promote students&rsquo; understanding and participation in the development, maintenance, and/or orderly change of community, social and legal standards or norms. It may challenge systems of power, privilege, and oppression. Events meeting this criteria may also encourage students to seek involvement with people different from oneself and promote involvement in diverse interests and may promote involvement in service or volunteer activities.'
	),
	array(
    	'name' => 'Meets one of CSIL&rsquo;s learning outcomes',
		'description' => 'The formal education of students consists of the curriculum and the co-curriculum, and must promote student learning and development that is purposeful and holistic. Programs and services must identify relevant and desirable student learning and development outcomes and provide programs and services that encourage the achievement of those outcomes. <strong>Please indicate which of the numbered learning outcomes this event is designed to achieve</strong> <input type="text" name="outcomes" value="{OUTCOMES}" /> <input type="button" name="listoutcomes" value="List Outcomes" onclick="return dsListOutcomes();" />'
	)
);

// Learning Outcomes
$outcomes = array(
	array(
    	'name' => 'Intellectual Growth',
		'description' => 'Produces personal and educational goal statements; Employs critical thinking in problem solving; Uses complex information from a variety of sources including personal experience and observation to form a decision or opinion; Obtains a degree; Applies previously understood information and concepts to a new   situation or  setting; expresses appreciation for literature, the fine arts, mathematics, sciences, and social sciences'
	),
	array(
		'name' => 'Effective Communication',
		'description' => 'Writes and speaks coherently and effectively; writes and speaks after reflection; Able to influence others through writing, speaking or artistic expression;  effectively articulates abstract ideas; Uses appropriate syntax; Makes presentations or gives performances'
	),
	array(
		'name' => 'Enhanced Self- Esteem',
		'description' => 'Shows self-respect and respect for others; Initiates actions toward achievement of goals; takes reasonable risks; Demonstrates assertive behavior; Functions  without need for constant reassurance from others'
	),
	array(
		'name' => 'Realistic Self-Appraisal',
		'description' => 'Articulates personal skills and abilities; Makes decisions and acts in congruence with personal values; Acknowledges personal strengths and weaknesses;  Articulates rationale for personal behavior; Seeks feedback from others; Learns from past experiences'
	),
	array(
		'name' => 'Clarified Values',
		'description' => 'Articulates personal values; Acts in congruence with personal values; Makes decisions that reflect personal values; Demonstrates willingness to scrutinize  personal beliefs and values; identifies personal work and lifestyle values and explains how they influence decision-making'
	),
	array(
		'name' => 'Career Choices',
		'description' => 'Articulate career choices based on assessment of interests, values, skills and abilities; Documents knowledge, skills and accomplishments resulting from  formal education, work experience, community service and volunteer experiences; Makes the connections between classroom and out-of-classroom learning;  Can construct a resume with clear job objectives and evidence of related knowledge, skills and preferred work environment; Comprehends the world of work;  Takes steps to initiate a job search or seek advanced education'
	),
	array(
		'name' => 'Leadership Development',
		'description' => 'Articulates leadership philosophy or style; Serves in a leadership position in a student organization; comprehends the dynamics of a group; Exhibits  democratic principals as a leader; Exhibits ability to visualize a group purpose and desired outcomes'
	),
	array(
		'name' => 'Meaningful Interpersonal Relationships',
		'description' => 'Develops and maintains satisfying interpersonal relationships; Establishes mutually rewarding relationships with friends and colleagues; Listens to and  considers others&rsquo; points of view; Treats others with respect'
	),
	array(
		'name' => 'Independence',
		'description' => 'Exhibits self-reliant behaviors; Functions autonomously; Exhibits ability to function interdependently; Accepts supervision as needed; Manages time effectively'
	),
	array(
		'name' => 'Satisfying and Productive Lifestyles',
		'description' => 'Achieves balance between education, work and leisure time; Articulates and meets goals for work, leisure and education; Overcomes obstacles that hamper  goal achievement; Functions on the basis of personal Identity, ethical, spiritual and moral values; Articulates long-term goals and objectives'
	),
	array(
		'name' => 'Spiritual Awareness',
		'description' => 'Develops and articulates personal belief system; Understands roles of spirituality in personal and group values and behaviors'
	),
	array(
		'name' => 'Personal and Education Goals',
		'description' => 'Sets, articulates and pursues individual goals; Articulates personal and educational goals and objectives; Uses personal and educational goals to guide  decisions; Understands the effect of one&rsquo;s personal and educational goals on others'
	)
);
?>