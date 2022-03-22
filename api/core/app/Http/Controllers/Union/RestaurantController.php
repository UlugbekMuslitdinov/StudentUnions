<?php
namespace App\Http\Controllers\Union;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SU\Loc;
use App\Model\SU\Restaurants;
use App\Model\SU\RestaurantSlides;
use App\Model\Hours\Hours;

class RestaurantController extends Controller 
{

    public function __construct()
    {
        // $this->middleware('suapi');
	}

    public function getRestaurants(Request $request){
        $locations = New Loc;
        $location = $locations->getRestaurants(str_replace('/', '', $request->location));

        if ($location == null){
            return response()->json([
                'success' => false
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'banner_img' => 'http://localhost',
            'restaurants' => $location
        ], 200);
    }

	public function getRestaurantDetail(Request $request){
        $locations = New Loc;
        $loc = $locations->getLocation($request->location, $request->restaurant);

        if ($loc == null){
            // No Location Found
            return response()->json([
                'success' => false
            ], 200);
        }

        $location_id = $loc->location_id;

        // Get Menus
        $restaurants = New Restaurants;
        $restaurant = $restaurants->getRestaurant($loc->location_id);

        // Get Operation Hour
        $hours = New Hours;
        $today_hour = $hours->getTodayHour($location_id);

        $open = $today_hour['open'];
        $close = $today_hour['close'];

        $isClosed = (($open==$close) && ($open == '00:00:00'));

        $hour = '';
        if($location_id == 999){
            echo "We will be CLOSED until mid August for remodeling.";
        } else {
            if( $isClosed == 1 || !isset($open) || !isset($close)) {
                $hour =  "Closed today.";
            }
            else if ($open == $close && $open != "00:00:00") {
                // highland market is open 24hrs during the regular school year.
                $hour = " Open 24hrs!";
            }
            else {
                $hour = $this->convertTime($open) . ' - ' . $this->convertTime($close);
            }
        }

        // Get Slides
        $restaurantslides = New RestaurantSlides;
        $slides = $restaurantslides->getSlides($loc->location_id);

        $newSlides = [];
        if (is_object($slides) && count($slides) != 0) {
            foreach( $slides as $slide ){
                $tmpSlide = ['filePath' => '/dining/template/images/slides/' . $slide->filename];
                array_push($newSlides, $tmpSlide);
            }
        }

        // Trim data
        $catering_online_order = null;
        if (($restaurant != null) && ($restaurant->button_form != null)){
            if (strpos($restaurant->button_form, 'pdf') !== false)
            {
                $catering_online_order = '/dining/template/resources/' . $restaurant->button_form;
            }
            else {
                $catering_online_order = '/catering/' . $restaurant->button_form . '/agreement.php?r=' . $request->restaurant;
            }
        }

        // Return Result
		return response()->json([
            'success' => true,
            'detail' => [
                'loading' => false,
                // 'shortname' => $request->restaurant,
                'banner_img' => ($restaurant != null ? '' . $restaurant->banner : null),
                'name' => $loc->location_name,
                'phone' => $loc->phone,
                'description' => $loc->long,
                'menu' => (($restaurant != null) && ($restaurant->button_menu != null) ? '/dining/menu.php?unit='.$loc->short_name : null),
                'pdf_menu' => (($restaurant != null) && ($restaurant->button_pdf != null) ? '/dining/template/resources/'.$restaurant->button_pdf : null),
                'catering_menu' => (($restaurant != null) && ($restaurant->button_catering != null) ? '/dining/template/resources/' . $restaurant->button_catering : null),
                'catering_online_order' => $catering_online_order,
                'hour' => $hour,
            ],
            'slides' => $newSlides,
        ], 200);
    }
    
    private function convertTime($time){

        list($hour, $min, $sec) = explode(":", $time);
    
        if ($hour >= 12) { // hour changes to pm at 12, not 13
            $hour = $hour >= 13 ? $hour - 12 : $hour; // if hour is indeed 13+, change to 1+
            $ampm = 'PM';
        } else {
            $ampm = 'AM';
        }
    
        $hour = (int)$hour; // cast to an int to get rid of leading 0
    
        if ($min == "00") {
            if ($hour == "00") return "mid";
            if ($hour == "12") return "noon";
            else return $hour . $ampm;
        } else {
            return $hour . ':' . $min . $ampm;
        }
    }
}