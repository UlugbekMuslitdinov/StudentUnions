@if (isset($data->lunchsandwich) && $data->lunchsandwich->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Lunch Sandwiches</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Signature Lunch Nosh Box --}}
    @if (isset($data->lunchsandwich->signature['full']['qty']) && $data->lunchsandwich->signature['full']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Signature Lunch Nosh Box - 10 Sandwiches</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->signature['full']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->signature['full']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->signature['full']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->lunchsandwich->signature['full']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">signature_10 #{{$loop->index + 1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->lunchsandwich->signature['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->lunchsandwich->signature['half']['qty']) && $data->lunchsandwich->signature['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Signature Lunch Nosh Box - 5 Sandwiches</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->signature['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->signature['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->signature['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->lunchsandwich->signature['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">signature_5 #{{$loop->index +1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->lunchsandwich->signature['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Signature Lunch Nosh Box --}}  


    {{-- Classic Lunch Nosh Box --}}
    @if (isset($data->lunchsandwich->classic['full']['qty']) && $data->lunchsandwich->classic['full']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Classic Lunch Nosh Box - 10 Sandwiches</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->classic['full']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->classic['full']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->classic['full']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->lunchsandwich->classic['full']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">classic_10 #{{$loop->index +1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->lunchsandwich->classic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->lunchsandwich->classic['half']['qty']) && $data->lunchsandwich->classic['half']['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Classic Lunch Nosh Box - 5 Sandwiches</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->classic['half']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->classic['half']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->classic['half']['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->lunchsandwich->classic['half']['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">classic_5 #{{$loop->index +1}}</span><br/>
                        
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->lunchsandwich->classic['items'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Classic Lunch Nosh Box --}}  


    {{-- Lunch For The Group --}}
    @if (isset($data->lunchsandwich->forGroup['qty']) && $data->lunchsandwich->forGroup['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">Lunch For The Group</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->forGroup['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->forGroup['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->forGroup['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->lunchsandwich->forGroup['list'] as $item)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">forGroup #{{$loop->index + 1}}</span><br/>
                    
                    Sandwich : <br />
                    @foreach ($item['sandwich'] as $key => $value)
                        @if ($value != 0)
                            - {{ $data->lunchsandwich->forGroup['items']['sandwich'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach

                    Cookie : <br />
		    - Chocolate Chip Cookies : 12 <br />
                    

                    Chip : <br />
                    @foreach ($item['chip'] as $key => $value)
                        @if ($value != 0)
                            - {{ $data->lunchsandwich->forGroup['items']['chip'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach

                    Drink : <br />
                    @foreach ($item['drink'] as $key => $value)
                        @if ($value != 0)
                            - {{ $data->lunchsandwich->forGroup['items']['drink'][$key]['name'] }} : {{ $value }} <br/>
                        @endif
                    @endforeach
                </p>
                
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Lunch For The Group --}}



    {{-- Lunch Boxes --}}
    @foreach (['turkey', 'harvest', 'ham', 'tasty', 'avocado', 'green', 'nova'] as $box_key)
        @if (isset($data->lunchsandwich->lunchBox[$box_key]['qty']) && $data->lunchsandwich->lunchBox[$box_key]['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td  class="first-item" style="font-size: 14px;">{{$data->lunchsandwich->lunchBox[$box_key]['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->lunchsandwich->lunchBox[$box_key]['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunchsandwich->lunchBox[$box_key]['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunchsandwich->lunchBox[$box_key]['total']}}</td>
        </tr>
        <tr class="sub-item" style="margin-top: 5px;">
            <td></td>
            <td colspan="2">

                @foreach ($data->lunchsandwich->lunchBox[$box_key]['list'] as $list)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">{{$box_key}} #{{$loop->index + 1}}</span><br/>

                    @if ($list['chip'] != null)
                        {{ $data->lunchsandwich->lunchBox['chips'][$list['chip']]['name'] }}<br/>
                    @endif

                    @if ($list['fruit'] != null)
                        Fruit<br/>
                    @endif
		    	Chocolate Chip Cookie<br />
                    

                </p>

                @endforeach

            </td>
        </tr>
        @endif
    @endforeach
    {{-- End : Lunch Boxes --}}


  


    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->lunchsandwich->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif