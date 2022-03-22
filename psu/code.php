<?php
header('Location: /');
exit();
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Park Student Union';
  $page_options['nav']['PSU']['Places to Eat']['link'] = '/dining/index.php';
  $page_options['nav']['PSU']['Maps']['link'] = '/infodesk/maps/index.php';
  $page_options['nav']['PSU']['Room Scheduling']['link'] = '/rooms/index.php';
  $page_options['nav']['PSU']['PSU BookStore']['link'] = 'http://www.uofabookstores.com/uaz/AboutUs/PSUHours.asp';
  $page_options['nav']['PSU']['Meeting Rooms']['link'] = '/psu/meeting.php';
  $page_options['nav']['PSU']['Photo Gallery']['link'] = '/about/gallery/index.php';
  $page_options['nav']['PSU']['Gaming Center']['link'] = '/psu/code.php';
  $page_options['header_image'] = '/template/images/banners/code.png';        
  page_start($page_options);
?>

<div id="content" style="margin-top:-20px;">
  <h1>CODE: PSU Gaming Center</h1>
  <h2>PSU Gaming Center Prices</h2>
  <p> <strong>Basic rates (per console)</strong><br />
    Single player - $2 per hour<br />
    &nbsp;&nbsp;<i>*Bring your own game and controllers for $1 off the hourly rate</i><br />
  </p>
  <h2>Get a Gaming Center membership!</h2>
  <ul>
    <li>Play free, all day, every day!</li>
    <li>Discounted rates</li>
    <li>Monthly drawings for prizes</li>
    <li>Just $25 for the semester</li>
  </ul>
 <hr />
  <p> Xbox 360 | PS3 | Wii </p>
  <p> Try the newest games. 
    Relax in style.
    Pwn your friends. </p>
  <p> <strong>GAMES:</strong> <br />
    <i> Halo 3 ODST<br />
    Street Fighter IV<br />
    Gears of War 2<br />
    Resident Evil 5<br />
    Uncharted 2: Among Thieves<br />
    Batman: Arkham Asylum<br />
    Guitar Hero 5<br />
    Madden 10<br />
    FIFA Soccer 10<br />
    NBA Live 10<br />
    Super Mario Galaxy<br />
    LittleBigPlanet<br />
    BioShock<br />
    Mario Kart<br />
    Super Smash Bros. Brawl<br />
    Dragon Age: Origins<br />
    ...AND MORE </i> </p>
  <p> <br />
  <p>
   <?php
   require_once('hours.inc');
	 printLocationHours(57); 
	?>
  </p>
</div>
<?php page_finish(); ?>
