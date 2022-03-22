@extends('catering.mail.retail_submit_confirmation')

@section('style')
<style>
h5.menu-section-title {
    color: #f58220;
    font-size: 19px;
    border-bottom: 1px solid #00275b;
}
tr.od-header {
    border-bottom: 1px solid #00275b;
}
tr.od-footer {
    border-top: 1px solid #00275b;
}

.first-item > td, td.first-item {
    font-size: 15px;
} 
.child-item > td:first-child {
    padding-left: 10px;
}
.child-item > td {
    font-size: 14px;
}
.sub-item {
    margin-top: 5px;
}
.sub-item > td > p {
    font-size: 12px;
}
.sub-item > td > p > .sub-item-title {
    font-size: 12px;
    color: #f58220;
}
.order-detail-footer {
    margin-top: 20px;
    border-top: 1px solid #00275b;
    border-bottom: 1px solid #00275b;
}
.order-detail-footer td:nth-child(2) {
    width: 130px;
}
</style>
@endsection

@section('content')
<table class="body" role="presentation"><tbody>
        <tr>
            <td class="center" align="center" valign="top">
                <table class="container float-center" align="center" width="600"><tbody><tr><th class="small-12 large-12 columns first last" style="padding: 16px;">

                    <p style="color:#00275b; font-size: 40px; font-weight: 600;">Student Unions</p>
                    
                    @if ($data->to == 'customer')
                        <h1>Thank you for your order.</h1>

                        <p>
                            Dear {{ $data->customer->firstname ?? '' }} {{ $data->customer->lastname ?? '' }}<br /><br />
                            Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.
                        </p>
                    @else
                        <h1>New Order Submission.</h1>

                        <p>
                            <br /><br />
                            There is a new order!<br/> Please check the order and follow up.
                        </p>
                    @endif

                    <hr>

                    <table class="spacer"><tbody><tr><td height="26px" style="font-size:16px;line-height:16px;">&nbsp;</td></tr></tbody></table>

                    <b>Name:</b> {{$data->customer->firstname}} {{$data->customer->lastname}}<br/>
                    <b>Email:</b> {{$data->customer->email}}<br/>
                    <b>Phone:</b> {{$data->customer->phone}}<br/>
                    <b>Pickup Location:</b> {{$data->customer->location}}<br/>
                    <b>Payment:</b> {{$data->customer->payment['type']}}<br/>

                    <hr>

                    <table class="spacer"><tbody><tr><td height="26px" style="font-size:16px;line-height:16px;">&nbsp;</td></tr></tbody></table>

                    <h4 class="text-center">Order Detail</h4>

                    @include('catering.mail.box.receipt')
                    
                </th></tr></tbody></table>
            </td>
        </tr>

    </tbody>
</table>

@endsection