<?php
namespace App\Http\Controllers\BoxMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SU\BoxMenu;

class BoxMenuController extends Controller 
{

    public function __construct()
    {
        // $this->middleware('suapi');
	}

    public function getData ($day) {
        $data = BoxMenu::get_data_from_day($day);

        $json_data = array('success' => true, 'data' => $data[0]);

        return response()->json($json_data, 200);
    }

}