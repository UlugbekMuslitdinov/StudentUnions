@if (isset($data->bk_fav) && $data->bk_fav->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Breakfast Favorites</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: left; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>

    {{-- Breakfast For The Group --}}
    @if (isset($data->bk_fav->for_group['qty']) && $data->bk_fav->for_group['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bk_fav->for_group['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->for_group['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->for_group['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bk_fav->for_group['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bk_fav->for_group['list'] as $item)

                @if (count($item) != 0)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">for_group #{{$loop->index + 1}}</span><br/>
                    
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)

                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                    - Reduced Fat {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                    - {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
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
    {{-- End : Breakfast For The Group --}}

    {{-- Traditional Nova Lox Salmon Platter --}}
    @if (isset($data->bk_fav->salmon_platter['qty']) && $data->bk_fav->salmon_platter['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bk_fav->salmon_platter['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->salmon_platter['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->salmon_platter['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bk_fav->salmon_platter['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bk_fav->salmon_platter['list'] as $item)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">salmon_platter #{{$loop->index + 1}}</span><br/>
                    
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)

                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                    - Reduced Fat {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                    - {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif

                            @endif
                        @endforeach
                    @endforeach
                </p>
                
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Traditional Nova Lox Salmon Platter --}}

    {{-- Mixed Bagels & Sweets Nosh Box --}}
    @if (isset($data->bk_fav->nosh_box['qty']) && $data->bk_fav->nosh_box['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bk_fav->nosh_box['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->nosh_box['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->nosh_box['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bk_fav->nosh_box['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bk_fav->nosh_box['list'] as $item)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">nosh_box #{{$loop->index + 1}}</span><br/>
                    
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)

                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                    - Reduced Fat {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                    - {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif

                            @endif
                        @endforeach
                    @endforeach
                </p>
                
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Mixed Bagels & Sweets Nosh Box --}}


    {{-- Bagel & Shmear Breakfast Box --}}
    @if (isset($data->bk_fav->bagel_shmear_break_box['qty']) && $data->bk_fav->bagel_shmear_break_box['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bk_fav->bagel_shmear_break_box['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->bagel_shmear_break_box['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->bagel_shmear_break_box['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bk_fav->bagel_shmear_break_box['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->bk_fav->bagel_shmear_break_box['list'] as $item)

                <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">bagel_shmear_break_box #{{$loop->index + 1}}</span><br/>
                    
                    @foreach ($item as $key => $values)
                        <span style="margin-bottom: 0px; color:#b36a3b;">{{$key}}</span><br/>
                        @foreach ($values as $v_key => $v_value)
                            @if ($v_value != 0)

                                @if ($key == 'whip' && $v_key != 'plain' && $v_key != 'onion' && $v_key != 'salmon')
                                    - Reduced Fat {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @else
                                    - {{ $data->bk_fav->{$key}[$v_key]['name'] }} : {{ $v_value }} <br/>
                                @endif

                            @endif
                        @endforeach
                    @endforeach
                </p>
                
            @endforeach
        </td>
    </tr>
    @endif
    {{-- End : Bagel & Shmear Breakfast Box --}}

    {{-- Power Protein Breakfast Box --}}
    @if ($data->bk_fav->power_protein_breakfast_box['qty'] != 0)
        <tr class="first-item" style="font-size: 15px;">
            <td class="first-item" style="font-size: 14px;">{{$data->bk_fav->power_protein_breakfast_box['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->power_protein_breakfast_box['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->power_protein_breakfast_box['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->bk_fav->power_protein_breakfast_box['total'],2)}}</td>
        </tr>
    @endif
    {{-- End : Power Protein Breakfast Box --}}

    {{-- Pastry Breakfast Box --}}
    @if (isset($data->bk_fav->Pastry_breakfast_box['qty']) && $data->bk_fav->Pastry_breakfast_box['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->bk_fav->Pastry_breakfast_box['name']}}</td><td class="text-center" style="font-size: 14px; text-align: left;">${{$data->bk_fav->Pastry_breakfast_box['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->bk_fav->Pastry_breakfast_box['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->bk_fav->Pastry_breakfast_box['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            <p style="font-size: 12px; border: 1px solid #e1e1e1;">
                    <span class="sub-item-title" style="font-size: 12px; color: #f58220;">Pastry Breakfast Box </span><br/>
            @foreach ($data->bk_fav->Pastry_breakfast_box['list'] as $key => $value)

                @if ($value != 0)
                    {{ $data->bk_fav->Pastry_breakfast_box['items'][$key]['name'] }} : {{ $value }} <br/>
                @endif

            @endforeach
            </p>
        </td>
    </tr>
    @endif
    {{-- End : Pastry Breakfast Box --}}
    

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->bk_fav->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif