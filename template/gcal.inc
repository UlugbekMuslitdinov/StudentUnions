<?php
/*******************************************************************************
 *	Documentation for using the Google Calendar API with ZEND can be found in
 *     the following places:
 *
 *  - Inline code comments in entry_submit.php and caltest.php
 *
 *  - http://www.zfchina.org/manual/zh/zend.gdata.calendar.html
 *  - http://markmail.org/message/ayonb7klm5j2vsm6#query:php%20google%20calendar%20how%20to%20recurring+page:1+mid:bxy25ewk76o6bkgw+state:results
 *  - http://code.google.com/apis/calendar/
 *  - http://code.google.com/more/#google-products
 *  - http://code.google.com/apis/calendar/data/1.0/developers_guide_php.html
 *
*******************************************************************************/

// Seem to be standard Zend and class includes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

// Parameters for ClientAuth authentication
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
$user = 'azstudentunion@gmail.com';
$pass = 'sumc4414';

//$user = 'azwellutest@gmail.com';
//$pass = 'gcalstart86';

// Create an authenticated HTTP client
$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

// Create an instance of the Calendar service
$service = new Zend_Gdata_Calendar($client);