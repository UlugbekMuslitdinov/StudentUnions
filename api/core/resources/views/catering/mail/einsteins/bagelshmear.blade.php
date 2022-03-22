@if (isset($data->bagelandsheamr) && $data->bagelandsheamr->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Bagels & Shmear</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    @if (isset($data->bagelandsheamr->baker_dozen['qty']) && $data->bagelandsheamr->baker_dozen['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bagelandsheamr->baker_dozen['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bagelandsheamr->baker_dozen['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bagelandsheamr->baker_dozen['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bagelandsheamr->baker_dozen['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bagelandsheamr->baker_dozen['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">baker_dozen #{{($loop->index + 1)}}</span><br/>
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)
                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                     - Reduced Fat {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                     - {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->bagelandsheamr->half_dozen['qty']) && $data->bagelandsheamr->half_dozen['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bagelandsheamr->half_dozen['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bagelandsheamr->half_dozen['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bagelandsheamr->half_dozen['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bagelandsheamr->half_dozen['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bagelandsheamr->half_dozen['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">half_dozen #{{($loop->index + 1)}}</span><br/>
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)
                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                     - Reduced Fat {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                     - {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->bagelandsheamr->nosh_box['qty']) && $data->bagelandsheamr->nosh_box['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bagelandsheamr->nosh_box['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bagelandsheamr->nosh_box['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bagelandsheamr->nosh_box['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bagelandsheamr->nosh_box['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bagelandsheamr->nosh_box['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">nosh_box #{{($loop->index + 1)}}</span><br/>
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)
                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                     - Reduced Fat {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                     - {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif
    
    @if (isset($data->bagelandsheamr->whip['qty']) && $data->bagelandsheamr->whip['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bagelandsheamr->whip['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bagelandsheamr->whip['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bagelandsheamr->whip['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bagelandsheamr->whip['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bagelandsheamr->whip['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">whip #{{($loop->index + 1)}}</span><br/>
                    @foreach ($item as $key => $values)
		    <!-- @if ($key != 'bagel')
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/> -->
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)
                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                     - Reduced Fat {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                     - {{ $data->bagelandsheamr->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif
                            @endif
                        @endforeach
		    <!-- @endif -->
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->bagelandsheamr->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif