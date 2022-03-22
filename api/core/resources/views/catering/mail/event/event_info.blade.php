<table  class="small-12 large-12 columns" style="width: 100%; border-color: #666; border: 1px;" cellpadding="7"><tbody>

    <tr style='background: #ac051f;'><td colspan='2'><h2 style='text-align: center; color: white; margin-bottom: 0em;'><b>Arizona Catering Co.<br/>Event Request</b></h2></td></tr>

    <tr style='background: #eee;'><td style="width: 230px;"><strong>Department/Organization:</strong> </td><td>{{ $data->form->{'department-organization'} }}</td></tr>
    <tr><td><strong>Contact Name:</strong> </td><td>{{ $data->form->{'contact-name'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Phone Number:</strong> </td><td>{{ $data->form->{'phone'} }}</td></tr>
    <tr><td><strong>Mobile Number:</strong> </td><td>{{ $data->form->{'mobile'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Email:</strong> </td><td>{{ $data->form->{'email'} }}</td></tr>
    <tr><td><strong>Event Name:</strong> </td><td>{{ $data->form->{'event-name'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Event Date:</strong> </td><td>{{ date("m/d/Y", strtotime($data->form->{'event-date'})) }}</td></tr>
    <tr><td><strong>Event Start Time:</strong> </td><td>{{ date("h:i A", strtotime($data->form->{'event-start-time'})) }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Event End Time</strong> </td><td>{{ date("h:i A", strtotime($data->form->{'event-end-time'})) }}</td></tr>
    <tr><td><strong>Number of Attendees:</strong> </td><td>{{ $data->form->{'number-of-attendees'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Type of Service:</strong> </td><td>{{ $data->form->{'type-of-service'} }}</td></tr>

    @if ($data->form->{'type-of-service'} != 'Meeting Space Only')
    <tr><td style="width: 230px;"><strong>Catering Type:</strong> </td><td>{{implode (", ", $data->form->check_list) }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Catering Start Time:</strong> </td><td>{{ date("h:i A", strtotime($data->form->{'catering-start-time'})) }}</td></tr>
    <tr><td style="width: 230px;"><strong>Catering End Time:</strong> </td><td>{{ date("h:i A", strtotime($data->form->{'catering-end-time'})) }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Serviceware Selection:</strong> </td><td>{{ $data->form->{'servicewareRadio'} }}</td></tr>
    <tr><td style="width: 230px;"><strong>Catering Comments:</strong> </td><td>{{ $data->form->{'catering-comments'} }}</td></tr>
    @endif

    @if ($data->form->{'type-of-service'} === 'Catering Only')
    <tr><td style="width: 230px;"><strong>Building:</strong> </td><td>{{ $data->form->{'building'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Address:</strong> </td><td>{{ $data->form->{'address'} }}</td></tr>
    <tr><td style="width: 230px;"><strong>Room Number/Name:</strong> </td><td>{{ $data->form->{'room-number'} }}</td></tr>
    <tr style='background: #eee;'><td style="width: 230px;"><strong>Setup Style Note:</strong> </td><td>{{ $data->form->{'setup-notes'} }}</td></tr>
    @endif

    @if ($data->form->{'type-of-service'} !== 'Catering Only')
        <tr><td style="width: 230px;"><strong>Setup Style:</strong> </td><td>{{ $data->form->{'setup-style'} }}</td></tr>
        <tr style='background: #eee;'><td style="width: 230px;"><strong>Setup Comments:</strong> </td><td>{{ $data->form->{'setup-comments'} }}</td></tr>
        <tr><td style="width: 230px;"><strong>Audiovisual:</strong> </td><td>{{ $data->form->{'audiovisualRadio'} }}</td></tr>
        @if ($data->form->{'audiovisualRadio'} == 'Yes')
            <tr style='background: #eee;'><td style="width: 230px;"><strong>Audiovisual Comments:</strong> </td><td>{{ $data->form->{'audiovisual-comments'} }}</td></tr>
        @endif
        <tr><td style="width: 230px;"><strong>Additional Comments:</strong> </td><td>{{ $data->form->{'additional-comments'} }}</td></tr>
    @endif

    <tr style='background: #eee;'><td style="width: 230px;"><strong>Recurring:</strong> </td><td>
        @if ($data->form->{'paymentRadio'} != 'Yes')
        Recurring dates:  {{ $data->form->{'recurring-comments'} }}<br />
        @else
        {{ $data->form->{'recurringRadio'} }}
        @endif
    </td></tr>

    <tr style='background: #eee;'><td style="width: 230px;"><strong>Payment Method:</strong> </td><td>
        @if ($data->form->{'paymentRadio'} == 'account')
        UA IDB Account Number <br />
        - Account Number: {{ $data->form->{'account-number'} }}<br/>
        - Sub Account Number: {{ $data->form->{'sub-account-number'} }}
        @else
        {{ $data->form->{'paymentRadio'} }}
        @endif
    </td></tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>