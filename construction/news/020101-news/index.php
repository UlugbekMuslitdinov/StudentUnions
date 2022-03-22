<?
	if (!isset ($_SESSION)) {
	session_start();
}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'Tower Demolished';
	about_start($page_options);
	require_once ('/Library/WebServer/commontools/db.inc');
?>
<h2>Student Union Phase I Complete</h2>
<p>The east and north sides of the new Student Union Memorial Center are now open, making the first phase of the project complete. The U of A Bookstore opened in March on the northwest side of the building, while additional facilities came on line over the summer.</p>
<p>So what's new in the A-New-U? For starters, the new Wildcat Food Court houses old favorites such as Domino's, Java Jive Espresso Bar, McDonald's and the On Deck Deli. A new addition is Panda Express which serves Chinese food.</p>
<p>The new Cactus Grill (a bigger and much improved Fiddlee Fig) and Cafe Sonora, the University's most popular restaurant are also open. The Cactus Grill is situated on the third level of the new Union. On this level, you'll also find Sam's Video arcade, computer access terminals and two seating lounges. Cafe Sonora is located on the main level, southeast corner of the new Union.</p>
<p>Fast Copy, the Post Office, the CatCard and All-Aboard Meal Plan Offices, STA Travel (full service travel agency), U-Mart, and the Info. Desk are also open. Entrance is on the northeast corner, next to the Kiva, by the Administration Building. Fantastic Sams (full service hair salon) is s et to open later this Fall. Finally, look for Orville &amp; Wilbur's (chicken and salads) located by the east end of the new Union.</p>
<p>Phase II construction is now underway as demolition of the old Union &amp; Bookstore was completed in August. By December 2002, all 400,000 square feet of the new Student Union Memorial Center will be completed. Stay tuned.</p>

            
<? about_finish(); ?>