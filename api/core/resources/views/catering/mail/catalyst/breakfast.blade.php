@if (isset($data->breakfast) && $data->breakfast->total != 0)
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Breakfast</h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr class="od-header" style="border-bottom: 1px solid #c8942b;">
        <th style="font-size: 15px; border-bottom: 1px solid #c8942b;">Name</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Price</th><th style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="font-size: 15px; text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
    </tr>
    
    @if (isset($data->breakfast->bk_beginnings['qty']) && $data->breakfast->bk_beginnings['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td class="first-item" style="font-size: 14px;">{{$data->breakfast->bk_beginnings['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->breakfast->bk_beginnings['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right">{{$data->breakfast->bk_beginnings['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->breakfast->bk_beginnings['total']}}</td>
    </tr>
    @endif

    @if (isset($data->breakfast->ex_breakfast['qty']) && $data->breakfast->ex_breakfast['qty'] != 0)
    <tr class="first-item" style="font-size: 15px;">
        <td  class="first-item" style="font-size: 14px;">{{$data->breakfast->ex_breakfast['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->breakfast->ex_breakfast['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->breakfast->ex_breakfast['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->breakfast->ex_breakfast['total']}}</td>
    </tr>
    <tr class="sub-item" style="margin-top: 5px;">
        <td></td>
        <td colspan="3">
            @foreach ($data->breakfast->ex_breakfast['list'] as $item)
                @if (count($item) != 0)
                    <p style="font-size: 12px;">
                        <span class="sub-item-title" style="font-size: 12px; color: #f58220;">#{{$loop->count}}</span><br/>
                    @foreach ($item as $key => $value)
                        @if ($value != 0)
                            {{ $data->breakfast->ex_breakfast_name[$key] }} : {{ $value }} <br/>
                        @endif 
                    @endforeach
                    </p>
                @endif
            @endforeach
        </td>
    </tr>
    @endif

    @if (isset($data->breakfast->baker_dozen['qty']) && $data->breakfast->baker_dozen['qty'] != 0)
    <tr class="first-item" style="">
        <td class="first-item" style="font-size: 14px;">{{$data->breakfast->baker_dozen['name']}}</td><td class="text-center"  style="font-size: 14px; text-align: right;">${{$data->breakfast->baker_dozen['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->breakfast->baker_dozen['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{$data->breakfast->baker_dozen['total']}}</td>
    </tr>
    @endif

    <tr class="od-footer" style="border-top: 1px solid #c8942b;">
        <td colspan="3" style="border-top: 1px solid #c8942b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #c8942b; text-align: right;">${{$data->breakfast->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
@endif