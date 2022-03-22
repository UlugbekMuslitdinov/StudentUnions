<?php
namespace App\Http\Controllers\Catering\Box;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BoxEmail;
use Illuminate\Support\Facades\Mail;
use App\Model\SU\BoxMenu;
use App\Model\SU\BoxOrder;
use App\Model\SU\BoxChoice;

class OrderController extends Controller 
{

    public function __construct()
    {
        // $this->middleware('suapi');
	}

    public function submitOrder(Request $request){
        // $catering = New Catering;
        // $customer_info = $catering->where('id', session('order_id'))->first();

        $objData = new \stdClass();
        $objData->customer = (object) $request->customer;
        $objData->items = (object) $request->items;

        $objData->main = (object) [
            'qty' => $request->qty,
            'total' => $request->total
        ];
	
	//Set up the Facades Mail
        $objData->to = 'customer'; //set customer name
        $result = Mail::to($request->customer['email'])->send(new BoxEmail($objData)); //call Mail class method 'to'. Set customer email and send 

        $objData->to = 'manager'; //set manager name
        $result = Mail::to('su-web@email.arizona.edu')->send(new BoxEmail($objData)); //call Mail class method 'to'. Set manager or testing email and send.

        // Update Order
        $BoxOrder = New BoxOrder;
        $BoxOrder->first_name = $request->customer['firstname'];
        $BoxOrder->last_name = $request->customer['lastname'];
        $BoxOrder->email = $request->customer['email'];
        $BoxOrder->phone = $request->customer['phone'];
        $BoxOrder->location = $request->customer['location'];
        $BoxOrder->payment = $request->customer['payment']['type'];
        $BoxOrder->netid = $request->customer['netid'];
        $BoxOrder->sid = base64_decode($request->customer['id']);
        $BoxOrder->amount_swipe = $request->qty;
        $BoxOrder->amount_total = $request->total;
        $BoxOrder->save();

        $order_id = $BoxOrder->id;

        // // Save Selected Menus
        for ($i = 0; $i < 4; $i++){
            $item = $request->items[$i];

            if (count($item) > 0){

                $mealname = ['breakfast', 'lunch', 'dinner'];
                foreach ($mealname as $key => $value) {
                    if (isset($item[$value]) && count($item[$value]) > 0){
                        $BoxChoice = New BoxChoice;
                        for($j = 0; $j < count($item[$value]); $j++){
                            $list = $item[$value][$j];
                            $BoxChoice->order_id = $order_id;
                            $BoxChoice->box_id = $list['item_id']+1;
                            $BoxChoice->pickup_date = $list['date']['year'] . '-' . $list['date']['month'] . '-' . $list['date']['date'];
                            $BoxChoice->meal = $list['meal'];
                            $BoxChoice->box_name = $list['name'];
                            $BoxChoice->save();
                        }
                    }
                }
            }
        }


        return response()->json([
            'success' => true,
            'return' => [
                'order_id' => $order_id,
                'email' => $request->customer['email'],
                'text' => ''
            ]
        ], 200);
    }

    public function getMenu(Request $request){
        $BoxMenu = New BoxMenu;
        $menu = $BoxMenu->getMenu($request->day);

        return response()->json([
            'success' => true,
            'return' => [
                'menu' => $menu
            ]
        ], 200);
    }

}