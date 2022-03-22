<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>

<table  class="small-12 large-12 columns order-detail-footer"  style="margin-top:20px; width: 100%; border-top: 1px solid #c8942b; border-bottom: 2px solid #c8942b;"><tbody>

    <tr>
        <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
        <td class="text-right">${{round($data->main->subtotal, 2)}}</td>
    </tr>
    <tr>
        <td colspan="3" class="text-right"><strong>Tax</strong></td>
        <td class="text-right">${{round($data->main->tax, 2)}}</td>
    </tr>
    @if ($data->customer_info->method == 'Delivery')
    <tr>
        <td colspan="3" class="text-right"><strong>Delivery Fee</strong></td>
        <td class="text-right">$10</td>
    </tr>
    @endif
    <tr>
        <td colspan="3" class="text-right"><strong>Total</strong></td>
        @if ($data->customer_info->method == 'Delivery')
            <td class="text-right">${{round($data->main->total+10, 2)}}</td>
        @else
            <td class="text-right">${{round($data->main->total, 2)}}</td>
        @endif
    </tr>

</tbody></table>

<table class="spacer"><tbody><tr><td height="36px" style="font-size:30px;line-height:30px;">&nbsp;</td></tr></tbody></table>

<table  class="small-12 large-12 columns order-detail-footer"  style="margin-top:20px; width: 100%; border-top: 1px solid #c8942b; border-bottom: 2px solid #c8942b;"><tbody>

    <tr>
        <td style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Additional Note</td>
    </tr>

    <tr>
        <td>{{$data->main->additional_note}}</td>
    </tr>

</tbody></table>