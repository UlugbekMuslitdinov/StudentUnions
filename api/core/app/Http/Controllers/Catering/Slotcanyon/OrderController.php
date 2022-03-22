<?php
namespace App\Http\Controllers\Catering\Slotcanyon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SlotcanyonEmail;
use Illuminate\Support\Facades\Mail;
use App\Model\SU\Catering;

class OrderController extends Controller 
{

    public function __construct()
    {
        // $this->middleware('suapi');
	}

    public function submitOrder(Request $request){

        if (session('order_id') == null){
            return response()->json([
                'success' => false,
                'return' => [
                    'code' => 101
                ]
            ], 200);
        }
        else {
            $catering = New Catering;
            $customer_info = $catering->where('id', session('order_id'))->first();

            $objData = new \stdClass();
            $objData->customer_info = $customer_info;
            $objData->breakfast = (object) $request->breakfast;
            $objData->byo_breakfast = (object) $request->byo_breakfast;
            $objData->lunch = (object) $request->lunch;
            $objData->office_party = (object) $request->office_party;
            $objData->beverage = (object) $request->beverage;
            $objData->main = (object) [
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total' => $request->total,
                'additional_note' => $request->additional_comment
            ];


            $objData->to = 'customer';
            $result = Mail::to($customer_info->customer_email)->send(new SlotcanyonEmail($objData));

            $objData->to = 'manager';
            // $result = Mail::to('su-retailcatering@email.arizona.edu')->send(new SlotcanyonEmail($objData));
            $result = Mail::to('su-web@email.arizona.edu')->send(new SlotcanyonEmail($objData));

            $order_id = session('order_id');

            // Update Order
            $catering->submissionCompelte($order_id, json_encode((array)$objData));
            // session(['order_id' => null]);

            return response()->json([
                'success' => true,
                'return' => [
                    'order_id' => $order_id,
                    'email' => $customer_info->customer_email,
                    'text' => $request->additional_note
                ]
            ], 200);
        }
    }

}