@if (isset($data->lunch) && $data->lunch->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Lunch Box</h5>
<table  class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    @if (isset($data->lunch->total) && $data->lunch->total != 0)

            <tr class="first-item" style="font-size: 15px;">
                <td>Lunch Box</td><td></td><td></td><td class="text-right"></td>
            </tr>

            @if ($data->lunch->qty != 0)

            <tr class="child-item"  style="font-size: 14px;">
            <td style="padding-left: 10px; font-size: 14px;"> - Lunch Box - Single</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->lunch->price}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->lunch->qty}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->lunch->total}}</td>
            </tr>

            <tr class="sub-item" style="margin-top: 5px;">
                <td colspan="4" style="padding-left: 30px;">
                    @foreach ($data->lunch->list as $item)
                        @if (count($item) != 0)
                            <p style="font-size: 12px; border: 1px solid #ececec; padding: 5px;">
                                <span class="sub-item-title" style="font-size: 12px; color: #f58220;"></span><br/>

                                @foreach ($item['choice_one']['list'] as $key => $value)
                                    @if ($value != 0)
                                        {{ $data->lunch->names[$key]['name'] }} : {{ $value }}<br />
                                    @endif
                                @endforeach
                                @foreach ($item['choice_two']['list'] as $key => $value)
                                    @if ($value != 0)
                                        {{ $data->lunch->names[$key]['name'] }} : {{ $value }}<br />
                                    @endif
                                @endforeach
                                @foreach ($item['choice_three']['list'] as $key => $value)
                                    @if ($value != 0)
                                        {{ $data->lunch->names[$key]['name'] }} : {{ $value }}<br />
                                    @endif
                                @endforeach
                            @if (array_key_exists('extra', $item))
                                @if ($item['extra']['list'][0]['one'] != 'None')
                                    - Extra 1<br />
                                    {{$item['extra']['list'][0]['one']}}
                                    @if ($item['extra']['list'][0]['two'] != 'None')
                                        , {{$item['extra']['list'][0]['two']}}
                                    @endif
                                    @if ($item['extra']['list'][0]['three'] != 'None')
                                        , {{$item['extra']['list'][0]['three']}}
                                    @endif
                                    <br />
                                @endif
                                @if ($item['extra']['list'][1]['one'] != 'None')
                                    - Extra 2<br />
                                    {{$item['extra']['list'][1]['one']}}
                                    @if ($item['extra']['list'][1]['two'] != 'None')
                                        , {{$item['extra']['list'][1]['two']}}
                                    @endif
                                    @if ($item['extra']['list'][1]['three'] != 'None')
                                        , {{$item['extra']['list'][1]['three']}}
                                    @endif
                                    <br />
                                @endif
                            @endif
                            </p>
                        @endif
                    @endforeach
                </td>
            </tr>

            @endif

        @endif

    <tr class="od-footer" style="border-top: 1px solid #c8942b;"><td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="border-top: 1px solid #c8942b; text-align: right;">${{$data->lunch->total}}</td></tr>
</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif