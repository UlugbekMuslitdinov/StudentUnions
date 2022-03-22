@extends('catering.mail.retail_submit_confirmation')

@section('style')
<style>
h5.menu-section-title {
    color: #f58220;
    font-size: 19px;
    border-bottom: 2px solid #c8942b;
}
tr.od-header {
    border-bottom: 1px solid #c8942b;
}
tr.od-footer {
    border-top: 1px solid #c8942b;
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
    border-top: 2px solid #c8942b;
    border-bottom: 2px solid #c8942b;
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

                    <p style="color:#ba6d39; font-size: 40px; font-weight: 600;">CATALYST CAFE</p>
                    
                    @if ($data->to == 'customer')
                        <h1>Thank you for your order.</h1>

                        <p>
                            Hi, {{ $data->customer_info->customer_name ?? '' }} <br /><br />
                            Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.
                        </p>
                    @else
                        <h1>New Catering Order Submission.</h1>

                        <p>
                            Hi,<br /><br />
                            There is a new order for Catalyst Cafe online catering!<br/> Please check the order and follow up.
                        </p>
                    @endif

                    <hr>

                    <table class="spacer"><tbody><tr><td height="26px" style="font-size:16px;line-height:16px;">&nbsp;</td></tr></tbody></table>

                    @include('catering.mail.customer_info')

                    <hr>

                    <table class="spacer"><tbody><tr><td height="26px" style="font-size:16px;line-height:16px;">&nbsp;</td></tr></tbody></table>

                    <h4 class="text-center">Order Detail</h4>

                    @include('catering.mail.catalyst.breakfast')

                    @include('catering.mail.catalyst.byo_bk')

                    @include('catering.mail.catalyst.lunch')

                    @include('catering.mail.catalyst.office_party')

                    @include('catering.mail.catalyst.beverage')

                    @include('catering.mail.catalyst.grandTotal')

                    <table class="small-12 large-12 columns"  cellpadding="0" cellspacing="0" style="margin-top:50px;border-top: 1px solid #c8942b;"> <tr> <td class="content-block" style="text-align:center; font-size:12px;color:#9e9e9e; padding-top: 10px;"> <span class="apple-link">Catalyst Cafe<br />1202 N. Cherry Avenue Biosciences Research Laboratories., Tucson AZ 85721</span> </td> </tr> </table>

                </th></tr></tbody></table>
            </td>
        </tr>
    </tbody>
</table>

@endsection