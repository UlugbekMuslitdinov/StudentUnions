
<h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px;"></h5>
<table class="small-12 large-12 columns" style="width: 100%"><tbody>

    @foreach ($data->items as $key => $item)
            
            @if (isset($item['breakfast']) && count($item['breakfast']) > 0)
                @foreach($item['breakfast'] as $ikey => $ivalue)
                    <tr class="first-item" style="font-size: 15px; border-bottom: 1px solid #e1e1e1;" colspan="2">
                        <td  class="first-item" style="font-size: 14px; padding-top: 3px; padding-bottom: 3px;">
                            <i>{{$ivalue['date']['day']}}, {{$ivalue['date']['month_name']}} {{$ivalue['date']['date']}}, {{$ivalue['date']['year']}}</i><br/>
                            <span style="text-transform: uppercase;">{{$ivalue['meal']}}</span> - Box {{$ivalue['item_id']+1}} : {{$ivalue['name']}}
                        </td>
                    </tr>
                @endforeach
            @endif

            @if (isset($item['lunch']) && count($item['lunch']) > 0)
                @foreach($item['lunch'] as $ikey => $ivalue)
                    <tr class="first-item" style="font-size: 15px; border-bottom: 1px solid #e1e1e1;" colspan="2">
                        <td  class="first-item" style="font-size: 14px; padding-top: 3px; padding-bottom: 3px;">
                            <i>{{$ivalue['date']['day']}}, {{$ivalue['date']['month_name']}} {{$ivalue['date']['date']}}, {{$ivalue['date']['year']}}</i><br/>
                            <span style="text-transform: uppercase;">{{$ivalue['meal']}}</span> - Box {{$ivalue['item_id']+1}} : {{$ivalue['name']}}
                        </td>
                    </tr>
                @endforeach
            @endif

            @if (isset($item['dinner']) && count($item['dinner']) > 0)
                @foreach($item['dinner'] as $ikey => $ivalue)
                    <tr class="first-item" style="font-size: 15px; border-bottom: 1px solid #e1e1e1;" colspan="2">
                        <td  class="first-item" style="font-size: 14px; padding-top: 3px; padding-bottom: 3px;">
                            <i>{{$ivalue['date']['day']}}, {{$ivalue['date']['month_name']}} {{$ivalue['date']['date']}}, {{$ivalue['date']['year']}}</i><br/>
                            <span style="text-transform: uppercase;">{{$ivalue['meal']}}</span> - Box {{$ivalue['item_id']+1}} : {{$ivalue['name']}}
                        </td>
                    </tr>
                @endforeach
            @endif

    @endforeach
</tbody></table>

<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>

<table class="small-12 large-12 columns" style="width: 100%"><tbody>
    <tr>
        <td colspan="3" style="border-top: 1px solid #00275b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #00275b; text-align: right;">Qty: {{$data->main->qty}}</td>
    </tr>
    <tr class="od-footer" style="border-top: 1px solid #00275b;">
        <td colspan="3" style="border-top: 1px solid #00275b;"></td><td class="text-right" style="font-size: 14px; border-top: 1px solid #00275b; text-align: right;">${{$data->main->total}}</td>
    </tr>

</tbody></table>
<table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>