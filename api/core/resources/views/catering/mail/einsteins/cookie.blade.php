@if (isset($data->cookie) && $data->cookie->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Cookies</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Cookie Variety Box --}}
    @if (isset($data->cookie->variety['half']['qty']) && $data->cookie->variety['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->cookie->variety['name']}} - Half Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->variety['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->variety['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->variety['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->variety['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">variety_half #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->items[$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->cookie->variety['dozen']['qty']) && $data->cookie->variety['dozen']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->cookie->variety['name']}} - Dozen</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->variety['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->variety['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->variety['dozen']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->variety['dozen']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">variety_dozen #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->items[$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Cookie Variety Box --}}  



    {{-- Sweets & Coffee Break --}}
    @if (isset($data->cookie->sweet['large']['qty']) && $data->cookie->sweet['large']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->cookie->sweet['name']}} - Large</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->sweet['large']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->sweet['large']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->sweet['large']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->sweet['large']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">sweet_large #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->items[$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->cookie->sweet['small']['qty']) && $data->cookie->sweet['small']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->cookie->sweet['name']}} - Small</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->sweet['small']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->sweet['small']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->sweet['small']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->sweet['small']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">sweet_small #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->items[$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Sweets & Coffee Break --}}  










    {{-- Kettle Potato Chips --}}
    @if (isset($data->cookie->kettle['large']['qty']) && $data->cookie->kettle['large']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Kettle Potato Chips - 10 bags</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->kettle['large']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->kettle['large']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->kettle['large']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->kettle['large']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">kettle_large #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->kettle['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->cookie->kettle['small']['qty']) && $data->cookie->kettle['small']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Kettle Potato Chips - 5 bags</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->kettle['small']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->kettle['small']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->kettle['small']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->kettle['small']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">kettle_small #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->kettle['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    
    @if (isset($data->cookie->kettle['single']['qty']) && $data->cookie->kettle['single']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Kettle Potato Chips - 1 bag</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->kettle['single']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->kettle['single']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->cookie->kettle['single']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->cookie->kettle['single']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">kettle_single #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->cookie->kettle['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- @if ($data->cookie->kettle_large['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Kettle Potato Chips - 10 bags</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->kettle_large['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->kettle_large['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->cookie->kettle_large['total'],2)}}</td>
        </tr>
    @endif

    @if ($data->cookie->kettle_small['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">Kettle Potato Chips - 5 bags</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->cookie->kettle_small['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->cookie->kettle_small['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->cookie->kettle_small['total'],2)}}</td>
        </tr>
    @endif --}}
    {{-- End : Kettle Potato Chips --}}

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->cookie->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif