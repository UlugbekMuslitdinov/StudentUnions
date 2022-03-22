@if (isset($data->egg_sandwich) && $data->egg_sandwich->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Egg Sandwiches</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Classic Egg Sandwich Nosh Box --}}
    @if (isset($data->egg_sandwich->classic['half']['qty']) && $data->egg_sandwich->classic['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->classic['name']}} - Half Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->classic['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->classic['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->classic['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->classic['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">classic_half #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->classic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->egg_sandwich->classic['dozen']['qty']) && $data->egg_sandwich->classic['dozen']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->classic['name']}} - Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->classic['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->classic['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->classic['dozen']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->classic['dozen']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">classic_dozen #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->classic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Classic Egg Sandwich Nosh Box --}}

    {{-- Signature Egg Sandwich Nosh Box --}}
    @if (isset($data->egg_sandwich->signature['half']['qty']) && $data->egg_sandwich->signature['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->signature['name']}} - Half Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->signature['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->signature['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->signature['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->signature['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">signature_half #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->signature['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->egg_sandwich->signature['dozen']['qty']) && $data->egg_sandwich->signature['dozen']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->signature['name']}} - Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->signature['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->signature['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->signature['dozen']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->signature['dozen']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">signature_dozen #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->signature['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Signature Egg Sandwich Nosh Box --}}

    {{-- Thintastic Egg Sandwich Nosh Box --}}
    @if (isset($data->egg_sandwich->thintastic['half']['qty']) && $data->egg_sandwich->thintastic['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->thintastic['name']}} - Half Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->thintastic['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->thintastic['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->thintastic['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->thintastic['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">thintastic_half #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->thintastic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->egg_sandwich->thintastic['dozen']['qty']) && $data->egg_sandwich->thintastic['dozen']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->egg_sandwich->thintastic['name']}} - Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->egg_sandwich->thintastic['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->egg_sandwich->thintastic['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->egg_sandwich->thintastic['dozen']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->egg_sandwich->thintastic['dozen']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">thintastic_dozen #{{($loop->index + 1)}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->egg_sandwich->thintastic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Thintastic Egg Sandwich Nosh Box --}}

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->egg_sandwich->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif