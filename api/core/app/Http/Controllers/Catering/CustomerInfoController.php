<?php
namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SU\Catering;

class CustomerInfoController extends Controller 
{

    public function __construct()
    {
        // $this->middleware('suapi');
	}

    public function get(Request $request){
        $catering = New Catering;
        $catering->location = $request->location;
        $catering->method = $request->delivery_option;
        $catering->delivery_date = date('Y-m-d', strtotime(str_replace('-', '/', $request->delivery_date)));
        $catering->delivery_time = $request->delivery_time;
        if ($request->delivery_option == 'Delivery') {
            $catering->delivery_building = $request->delivery_building;
            $catering->delivery_room = $request->delivery_room;
            $catering->onsite_name = $request->onsite_name;
            $catering->onsite_email = $request->onsite_email;
            $catering->onsite_phone = $request->onsite_phone;
        }

        // $catering-> = $request->;
        $catering->customer_name = $request->customer_name;
        $catering->customer_phone = $request->customer_phone;
        $catering->customer_email= $request->customer_email;
        $catering->payment_method = $request->payment_method;
        $catering->delivery_notes = $request->delivery_notes;
        $catering->status = $request->status;

        if ($request->payment_method == 'IDB'){
            $catering->account_num = $request->account_num;
            $catering->sub_code = $request->sub_code;
        }
        
        $catering->save();

        $id = $catering->id;

        // echo $id;

        session(['order_id' => $id]);

        if ($id != null){
            // header('Location: http://192.168.99.100/catering/online/'.$request->location);
            return redirect()->to('../catering/online/'.$request->location);
        }
        else {
        }
    }

    public function getDeliveryMethod(Request $request) {
        $catering = New Catering;
        $customer_info = $catering->where('id', session('order_id'))->first();

        return response()->json([
            'success' => true,
            'return' => [
                'delivery_method' => $customer_info->method,
                // 'delivery_method' => 'Delivery',
                'id' => session('order_id')
            ]
        ], 200);
    }

}