<?php
namespace App\Http\Controllers\Catering\Einsteins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EinsteinsEmail;
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
            $objData->bagelandsheamr = (object) $request->bagelandsheamr;
            $objData->egg_sandwich = (object) $request->egg_sandwich;
            $objData->bk_fav = (object) $request->bk_fav;
            $objData->sweet_snack = (object) $request->sweet_snack;
            $objData->beverage = (object) $request->beverage;
            $objData->fresh_salads = (object) $request->fresh_salads;
            $objData->cookie = (object) $request->cookie;
            $objData->lunchsandwich = (object) $request->lunchsandwich;

            $objData->main = (object) [
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total' => $request->total,
                'additional_note' => $request->additional_comment
            ];

            $success = true;

            $objData->to = 'customer';
            $result = Mail::to($customer_info->customer_email)->send(new EinsteinsEmail($objData));

            $customer_did = $result;

            if (Mail::failures()){
                $success = false;
            }
		
            $objData->to = 'manager';
            // $result = Mail::to('su-retailcatering@email.arizona.edu')->send(new EinsteinsEmail($objData));
            $result = Mail::to('su-web@email.arizona.edu')->send(new EinsteinsEmail($objData));
	    	
            $order_id = session('order_id');

            // Update Order
            $catering->submissionCompelte($order_id, json_encode((array)$objData));
            session(['order_id' => null]);

            return response()->json([
                'success' => $success,
                'return' => [
                    'order_id' => $order_id,
                    'email' => $customer_info->customer_email,
                    'text' => $request->additional_note,
                    'mail' => Mail::failures(),
                    'customer' => $customer_did,
                    // 'success' => Mail::successes()
                ]
            ], 200);
        }
    }

}