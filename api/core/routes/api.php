<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/social/instagram/getlatestfeed','Union\Instagram\InstagramController@getLatestFeed');
Route::get('/upcomingevents/getlist','Union\UpcomingEventController@getList');
Route::get('/deliverance/getHomeImages','Deliverance\ResourceController@getHomeImages');
Route::post('/dining/getRestaurants','Union\RestaurantController@getRestaurants');
Route::post('/dining/getRestaurantDetail','Union\RestaurantController@getRestaurantDetail');
//Route::get('/dining/getRestaurants','Union\RestaurantController@getRestaurants');
//Route::get('/dining/getRestaurantDetail','Union\RestaurantController@getRestaurantDetail');

Route::post('/catering/getGalleryImages','Catering\GalleryController@getImages');
Route::post('/catering/event/confirmation','Catering\EventController@confirmation');
Route::post('/catering/event/new','Catering\EventController@newRequest');

Route::post('/catering/retail/customer_info','Catering\CustomerInfoController@get');
Route::post('/catering/retail/customer_info/getDeliveryMethod','Catering\CustomerInfoController@getDeliveryMethod');

Route::post('/catering/retail/iq_fresh/submit','Catering\IQ_Fresh\OrderController@submitOrder');
Route::post('/catering/retail/catalyst/submit','Catering\Catalyst\OrderController@submitOrder');
Route::post('/catering/retail/slotcanyon/submit','Catering\Slotcanyon\OrderController@submitOrder');
Route::post('/catering/retail/einsteins/submit','Catering\Einsteins\OrderController@submitOrder');

Route::post('/catering/retail/box/submit','Catering\Box\OrderController@submitOrder');
Route::get('/dining/box/menu','Catering\Box\OrderController@getMenu');

Route::get('/outlook/signin', 'MS\AuthController@signin');
Route::get('/outlook/authorize', 'MS\AuthController@gettoken');
Route::get('/outlook/calendar', 'MS\CalendarController@calendar')->name('calendar');
Route::get('/outlook/calendar/create', 'MS\CalendarController@createEvent');
Route::get('/outlook/calendar/update', 'MS\CalendarController@updateEvent');
Route::get('/catering/delivery_time/{location}','Catering\CustomerInfoController@getDeliveryTime');
Route::get('/boxes/getlist/{day}','BoxMenu\BoxMenuController@getData');