<?php 
header ("Content-Type:text/xml");
print '<?xml version="1.0" encoding="ISO-8859-1"?>';
?>
<data xmlns="http://arizona.edu/studentaffairs/mobile_places_feed">
  <TCCategory>
    <name>Dining</name>
    <children>
        <TCCategory>
            <name>Student Union</name>        
            <children/>
            <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=studentunion</category_id>
        </TCCategory>
        <TCCategory>
            <name>PSU</name>        
            <children/>
            <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=psu</category_id>
        </TCCategory>
        <TCCategory>
            <name>Around Campus</name>        
            <children/>
            <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=other</category_id>
        </TCCategory>
    </children>
    <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=dining</category_id>
  </TCCategory>
  <TCCategory>
    <name>Student Services</name>
    <children/>
    <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=studentservices</category_id> 
  </TCCategory>
  <TCCategory>
    <name>Academic</name>
    <children/>
    <category_id>http://union.arizona.edu/dining/mobile_places_feed_places.php?tags=academic</category_id> 
  </TCCategory>
</data>