@extends('catering.mail.retail_submit_confirmation')

@section('style')
<style>
body, table.body, h1, h2, h3, h4, h5, h6, p, td, th, a {
    font-family: initial;
}
body {
	width: 90%;
}
table.container {
    width: 750px;
}
td:first-child {
    width: 230px;
}
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

.last-link a {
    color: #8b0015;
}
</style>
@endsection

@section('content')
<table class="body" role="presentation"><tbody>
        <p><b>
            {{$data->line1}}<br><br>
            {{$data->line2}}<br><br>
            {{$data->line3}}<br><br>
            {{$data->line4}}<br><br>
            {{$data->line5}}<br>
            {{$data->line6}}<br>
            {{$data->line7}}<br>
            {{$data->line8}}<br>
            {{$data->line9}}<br>
            <span class="last-link">{{$data->line10}}</span><br>
        </b></p>
        <img src="https://su-wdevtest.union.arizona.edu/catering/template/signature_AZCE.png" alt="Arizona Catering & Events Co.">
        <tr>
            <td class="center" align="center" valign="top">
                <table class="container float-center" align="center" width="800"><tbody><tr><th class="small-12 large-12 columns first last" style="padding: 16px;">

                    {{-- <p style="color:#ba6d39; font-size: 40px; font-weight: 600;">Arizona Catering Co. - Event Request</p> --}}
                    <h1 style="font-size: 25px;"><b>{{$data->title}}</b></h1>
                    <p>{{$data->msg}}</p>

                    <hr>

                    <table class="spacer"><tbody><tr><td height="26px" style="font-size:16px;line-height:16px;">&nbsp;</td></tr></tbody></table>

                    @include('catering.mail.event.event_info')
                    
                </th></tr></tbody></table>
            </td>
        </tr>

    </tbody>
</table>

@endsection