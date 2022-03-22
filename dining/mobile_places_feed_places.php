<?php
header ("Content-Type:text/xml");
include('hours.inc');
require_once ('includes/mysqli.inc');
$db = new db_mysqli('hours2');

$query = 'SELECT * FROM location WHERE group_id=5';
$query2 = 'SELECT * FROM location WHERE group_id=5';

switch($_GET['tags']){
  case 'studentunion':
    $query = 'SELECT * FROM location WHERE group_id=1 AND subgroup="Dining"';
  break;
  
  case 'psu':
    $query = 'SELECT * FROM location WHERE group_id=2';
  break;
  
  case 'other':
    $query = 'SELECT * FROM location WHERE group_id=3';
  break;
  
  case 'studentservices':
	$query = 'SELECT * FROM location WHERE ua_mobile_categories="Student Services"';
    $query2 = 'SELECT * FROM places WHERE category="Student Services"';
  break;
  
  case 'academic':
    $query2 = 'SELECT * FROM places WHERE category="Academic"'; 
  break;
  
  default:
	$query = 'SELECT * FROM location WHERE group_id in(1,2,3)';
	$query2 = 'SELECT * FROM places'; 
  break;
}

$result2 = $db->query($query2);
$result = $db->query($query);

$placesId = 0;

while($loc = $result2->fetch_array())
{
		$location = array();
		$location['name'] = htmlspecialchars($loc['name'], ENT_QUOTES);
		$location['category'] = htmlspecialchars($loc['category'], ENT_QUOTES);
		$location['url'] = htmlspecialchars($loc['url'], ENT_QUOTES);
		$location['email'] = htmlspecialchars($loc['email'], ENT_QUOTES);
		$location['building'] = htmlspecialchars($loc['building'], ENT_QUOTES);
		$location['building_id'] = htmlspecialchars($loc['building_id'], ENT_QUOTES);
		$location['mailing_address'] = htmlspecialchars($loc['mailing_address'], ENT_QUOTES);
		$location['main_phone'] = htmlspecialchars($loc['main_phone'], ENT_QUOTES);
		$location['other_phone'] = htmlspecialchars($loc['other_phone'], ENT_QUOTES);
		$location['fax'] = htmlspecialchars($loc['FAX'], ENT_QUOTES);
		$location['id'] = "p-".$placesId++;
		$location['latitude'] = htmlspecialchars($loc['lat'], ENT_QUOTES);
		$location['longitude'] = htmlspecialchars($loc['long'], ENT_QUOTES);	
    $location['notes'] = htmlspecialchars($loc['notes'], ENT_QUOTES);
    	$location['tag'] = $loc['category'];
		$locations2[] = $location;
}

while($loc = $result->fetch_array()){
	
	  $location = array();
	  $location['open'] = getOpenStatus($loc['location_id'])?'true':'false';
	  $location['name'] = htmlspecialchars($loc['location_name'], ENT_QUOTES);
	  $location['building_id'] = 0;
	  $location['latitude'] = $loc['lat'];
	  $location['longitude'] = $loc['long'];
	  $location['location'] = $building;
	  $location['id'] = $loc['location_id'];
	  $location['location_url'] = $loc['location_url'];
	  $location['openString'] = getOpenStatus($loc['location_id'])?'Open':'Closed'; 

    if($location['name'] == "Computer Lab"){
      //Need to make this more descriptive for the Mobile app, but don't want to change it on the Union Site
      $location['name'] = "SUMC lower level";
    }
	  
	  //$link = db_connect();
	  //db_select('hours2',$link);
	 
	$time = time();

	$date = date("Y-m-d", $time);

	$dow = date("N", $time)-1;

	$week_start = date("Y-m-d", ($time-$dow*86400));
	$week_end = date("Y-m-d", ($time+(6-$dow)*86400));

	  $query1 = 'SELECT * FROM hours JOIN periods ON hours.type=periods.type WHERE start_date <= "'.$date.'" AND end_date>"'.$date.'" AND location_id='.$loc['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'SELECT * FROM exceptions WHERE date_of>="'.$week_start.'" AND date_of<="'.$week_end.'" AND location_id='.$loc['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
	  
	  $location['times'] = array();
	  $location['times']['monday-open'] = $location1[1];
	  $location['times']['monday-close'] = $location1[2];
	  $location['times']['tuesday-open'] = $location1[3];
	  $location['times']['tuesday-close'] = $location1[4];
	  $location['times']['wednesday-open'] = $location1[5];
	  $location['times']['wednesday-close'] = $location1[6];
	  $location['times']['thursday-open'] = $location1[7];
	  $location['times']['thursday-close'] = $location1[8];
	  $location['times']['friday-open'] = $location1[9];
	  $location['times']['friday-close'] = $location1[10];
	  $location['times']['saturday-open'] = $location1[11];
	  $location['times']['saturday-close'] = $location1[12];
	  $location['times']['sunday-open'] = $location1[13];
	  $location['times']['sunday-close'] = $location1[14];
	  
	  if($loc['ua_mobile_categories'] == "0"){
	  	$location['tag2'] = "Dining";
		  if($loc['group_id'] == 1) {
		  	$location['tag'] = "Student Union";
		  }
		  else if($loc['group_id'] == 2) {
		  	$location['tag'] = "Park Student Union";
		  }
		  else if($loc['group_id'] == 3) {
		  	$location['tag'] = "Around Campus";
		  }
	  }
	  else
	  	$location['tag2'] = $loc['ua_mobile_categories'];
	  
	  
	  
  	  $locations[] = $location;
}

// ACB
// The U of A Bookstores are not in the database
// because the bookstore manages its own hours'
// XML. We will fetch this, parse it, and insert
// it into our array.
$bookstore_url = 'http://uabookstores.arizona.edu/events_manager/UABhours.xml';
$bookstore_xml = simplexml_load_file($bookstore_url);

// Convert XML to array and grab the list of PLPlaces
$json = json_encode($bookstore_xml);
$array = json_decode($json, TRUE);
$stores = $array['PLPlace']; // Contains multiple entries

// Create date array for use in loop
$times = array('sunday-open', 'sunday-close', 'monday-open', 'monday-close',
  'tuesday-open', 'tuesday-close', 'wednesday-open', 'wednesday-close', 'thursday-open',
  'thursday-close', 'friday-open', 'friday-close', 'saturday-open', 'saturday-close');

// There are multiple bookstores. Iterate store locations.
foreach($stores as $store)
{
	// Hours in the location array are stored in a 'times' sub-array
	// We must iteratively demote each time.
	foreach($times as $value)
	{
		$store['times'][$value] = $store[$value];
		unset($store[$value]);
	}
	// These variables also need to be relocated
	$store['location_url'] = $store['url'];
	unset($store['url']);
	$store['openString'] = $store['openCloseString'];
	unset($store['openCloseString']);
	// If the building_id is not a number, empty it
	if(!is_numeric($store['building_id']))
		$store['building_id'] = '';
	
	// Add bookstore to locations
	$locations[] = $store;
}

// There will be an array in locations1, locations2, or both
// We make one array with all the elements
if(is_array($locations))
{
	if(is_array($locations2))
		$locations_comb = array_merge($locations, $locations2);
	else
		$locations_comb = $locations;
}
else
	$locations_comb = $locations2;

// Sort the establishments by name alphabetically
$locations_comb = subval_sort($locations_comb,'name'); 

// subval_sort
// Sorts 2-Dimensional Arrays by the values
// of specified subkeys.
// Found at:
// http://www.firsttube.com/read/sorting-a-multi-dimensional-array-with-php/
function subval_sort($a,$subkey)
{
	foreach($a as $k=>$v)
	{
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val)
	{
		$c[] = $a[$key];
	}
	return $c;
}

print '<?xml version="1.0" encoding="ISO-8859-1"?>';?>
<data xmlns="http://arizona.edu/studentaffairs/mobile_places_feed">
	
<?php 
	foreach($locations_comb as $loc)
	{
		if(in_array($loc, $locations))
		{
			?>
            <PLPlace> 
            <open><?=$loc['open']?></open>
            <name><?=$loc['name']?></name>
            <?php
                foreach($loc['times'] as $key => $value)
                {
                    echo "<".$key.">".$value."</".$key.">\n";
                }
             ?>
            <building_id><?=$loc['building_id']?></building_id>
            <latitude><?=$loc['latitude']?></latitude>
            <longitude><?=$loc['longitude']?></longitude>
            <location><?=$loc['location']?></location>
            <id><?=$loc['id']?></id>
            <url><?=$loc['location_url'][0]=="h"?$loc['location_url']:'http://union.arizona.edu'.$loc['location_url'];?></url>
            <openCloseString><?=$loc['openString']?></openCloseString>
            <tag><?=$loc['tag2']?></tag>
            <tag><?=$loc['tag']?></tag>
            </PLPlace>
        	<?php
		}
		else
		{
			print '<PLPlace>';
			foreach($loc as $key => $value)
			{
				echo "<".$key.">".$value."</".$key.">\n";
			}
			print '</PLPlace>';
		}
	}
	?>
</data>
<?php
$db = new db_mysqli('test');
$db->query("insert into `1` set id=NULL");
?>
