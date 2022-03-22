@if (isset($data->beverage) && $data->beverage->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Beverage</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="text-align: right; font-size: 15px; border-bottom: 1px solid #c8942b;">Price</th><th style="text-align: right; font-size: 15px; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    @foreach ($data->beverage->list as $item)

        @if ($item['qty'] != 0)
            <tr class="first-item" style="font-size: 15px;">
                <td class="first-item" style="font-size: 14px;">{{$item['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$item['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$item['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($item['price']*$item['qty'],2)}}</td>
            </tr>
        @endif
        
    @endforeach

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="border-top: 1px solid #c8942b; text-align: right;">${{$data->beverage->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif