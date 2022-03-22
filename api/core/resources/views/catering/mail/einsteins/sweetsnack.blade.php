@if (isset($data->sweet_snack) && $data->sweet_snack->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Sweets & Snacks</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Seasonal Fresh Fruit Salad --}}
    @if ($data->sweet_snack->salad_large['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Seasonal Fresh Fruit Salad - Large</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->salad_large['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->salad_large['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->salad_large['total'],2)}}</td>
        </tr>
    @endif

    @if ($data->sweet_snack->salad_small['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Seasonal Fresh Fruit Salad - Small</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->salad_small['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->salad_small['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->salad_small['total'],2)}}</td>
        </tr>
    @endif
    {{-- End : Seasonal Fresh Fruit Salad --}}

    {{-- Vanilla Strawberry Granola Parfait --}}
    @if ($data->sweet_snack->parfait['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td class="first-item" style="font-size: 14px;">{{$data->sweet_snack->parfait['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->parfait['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->parfait['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->parfait['total'],2)}}</td>
    </tr>
    @endif
    
    @if ($data->sweet_snack->parfait_individual['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td class="first-item" style="font-size: 14px;">{{$data->sweet_snack->parfait_individual['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->parfait_individual['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->parfait_individual['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->parfait_individual['total'],2)}}</td>
    </tr>
    @endif
    {{-- End : Vanilla Strawberry Granola Parfait --}}

    {{-- Sweets Nosh Box --}}
    @if ($data->sweet_snack->noshbox_half['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td class="first-item" style="font-size: 14px;">Sweets Nosh Box - Half</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->noshbox_half['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->noshbox_half['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->noshbox_half['total'],2)}}</td>
    </tr>
    @endif
    @if ($data->sweet_snack->noshbox_dozen['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td class="first-item" style="font-size: 14px;">Sweets Nosh Box - Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->noshbox_dozen['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->noshbox_dozen['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->sweet_snack->noshbox_dozen['total'],2)}}</td>
    </tr>
    @endif
    {{--@if (isset($data->sweet_snack->noshbox['half']['qty']) && $data->sweet_snack->noshbox['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->sweet_snack->noshbox['name']}} - Half Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->noshbox['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->noshbox['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->sweet_snack->noshbox['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->sweet_snack->noshbox['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">noshbox_half #{{$loop->count}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->sweet_snack->noshbox['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->sweet_snack->noshbox['dozen']['qty']) && $data->sweet_snack->noshbox['dozen']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->sweet_snack->noshbox['name']}} - Baker's Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->sweet_snack->noshbox['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->sweet_snack->noshbox['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->sweet_snack->noshbox['dozen']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->sweet_snack->noshbox['dozen']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">noshbox_baker #{{$loop->count}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->sweet_snack->noshbox['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif--}}
    {{-- End : Sweets Nosh Box --}}  

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->sweet_snack->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif