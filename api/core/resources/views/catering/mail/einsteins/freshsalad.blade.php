@if (isset($data->fresh_salads) && $data->fresh_salads->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Sweets & Snacks</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Strawberry Chicken Salad --}}
    @if (isset($data->fresh_salads->chicken['qty']) && $data->fresh_salads->chicken['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Strawberry Chicken Salad - Single</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->fresh_salads->chicken['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->fresh_salads->chicken['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->fresh_salads->chicken['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">chicken </span><br/>
            @foreach ($data->fresh_salads->chicken['selected'] as $key => $value)

                @if (array_key_exists($key, $data->fresh_salads->items['bagel']))
                    @if ($value != 0)
                        {{ $data->fresh_salads->items['bagel'][$key]['name'] }} : {{ $value }} <br/>
                    @endif
                @elseif (array_key_exists($key, $data->fresh_salads->items['chips']))
                    @if ($value != 0)
                        {{ $data->fresh_salads->items['chips'][$key]['name'] }} : {{ $value }} <br/>
                    @endif
                @endif

            @endforeach
            </p>
        </td>
    </tr>
    @endif

    @if ($data->fresh_salads->chicken_group['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Strawberry Chicken Salad - Group</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->fresh_salads->chicken_group['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->fresh_salads->chicken_group['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->fresh_salads->chicken_group['total'],2)}}</td>
        </tr>
    @endif
    {{-- End : Strawberry Chicken Salad --}}





    {{-- Strawberry Almond Salad --}}
    @if (isset($data->fresh_salads->almond['qty']) && $data->fresh_salads->almond['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Strawberry Almond Salad - Single</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->fresh_salads->almond['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->fresh_salads->almond['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->fresh_salads->almond['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">almond </span><br/>
            @foreach ($data->fresh_salads->almond['selected'] as $key => $value)

                @if (array_key_exists($key, $data->fresh_salads->items['bagel']))
                    @if ($value != 0)
                        {{ $data->fresh_salads->items['bagel'][$key]['name'] }} : {{ $value }} <br/>
                    @endif
                @elseif (array_key_exists($key, $data->fresh_salads->items['chips']))
                    @if ($value != 0)
                        {{ $data->fresh_salads->items['chips'][$key]['name'] }} : {{ $value }} <br/>
                    @endif
                @endif

            @endforeach
            </p>
        </td>
    </tr>
    @endif

    @if ($data->fresh_salads->almond_group['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Strawberry Almond Salad - Group</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->fresh_salads->almond_group['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->fresh_salads->almond_group['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->fresh_salads->almond_group['total'],2)}}</td>
        </tr>
    @endif
    {{-- End : Strawberry Almond Salad --}}



    

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->fresh_salads->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif