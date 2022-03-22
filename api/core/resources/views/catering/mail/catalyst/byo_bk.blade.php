@if (isset($data->byo_breakfast) && $data->byo_breakfast->total != 0)
    <h5 class="mb-0 menu-section-title" style="color: #f58220; font-size: 19px; border-bottom: 2px solid #c8942b;">Build Your Own Breakfast</h5>
    <table  class="small-12 large-12 columns" style="width: 100%"><tbody>
        <tr class="od-header"  style="border-bottom: 1px solid #c8942b;">
            <th style="border-bottom: 1px solid #c8942b;">Name</th><th style="text-align: right; border-bottom: 1px solid #c8942b;">Price</th><th style="text-align: right; border-bottom: 1px solid #c8942b;">Quantity</th><th class="text-right" style="text-align: right; border-bottom: 1px solid #c8942b;">Total</th>
        </tr>

        @if (isset($data->byo_breakfast->coffee_carafe) && $data->byo_breakfast->coffee_carafe['total'] != 0)

            <tr class="first-item" style="font-size: 15px;">
                <td>96oz Wildcat Coffee Carafe</td><td></td><td></td><td class="text-right"></td>
            </tr>

            @if ($data->byo_breakfast->coffee_carafe['list']['regular'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px; font-size: 14px;"> - Regular</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->coffee_carafe['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->coffee_carafe['list']['regular']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->coffee_carafe['list']['regular']*$data->byo_breakfast->coffee_carafe['price'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->coffee_carafe['list']['decaf'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px; font-size: 14px;"> - Decaf</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->coffee_carafe['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->coffee_carafe['list']['decaf']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->coffee_carafe['list']['decaf']*$data->byo_breakfast->coffee_carafe['price'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->coffee_carafe['list']['iced'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px;font-size: 14px;"> - Iced</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->coffee_carafe['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->coffee_carafe['list']['iced']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->coffee_carafe['list']['iced']*$data->byo_breakfast->coffee_carafe['price'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->coffee_carafe['list']['iced_decaf'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px; font-size: 14px;"> - Iced Decaf</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->coffee_carafe['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->coffee_carafe['list']['iced_decaf']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->coffee_carafe['list']['iced_decaf']*$data->byo_breakfast->coffee_carafe['price'],2)}}</td>
            </tr>
            @endif

        @endif

        @if (isset($data->byo_breakfast->fruit_salad) && $data->byo_breakfast->fruit_salad['total'] != 0)

            <tr class="first-item" style="font-size: 15px;">
                <td>Fresh Seasonal Fruit Salad</td><td></td><td></td><td class="text-right"></td>
            </tr>

            @if ($data->byo_breakfast->fruit_salad['serve_20']['qty'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px; font-size: 14px"> - Serve 20</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->fruit_salad['serve_20']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->fruit_salad['serve_20']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->fruit_salad['serve_20']['qty']*$data->byo_breakfast->fruit_salad['serve_20']['price'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->fruit_salad['serve_8']['qty'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px; font-size: 14px;"> - Serve 8</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->fruit_salad['serve_8']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->fruit_salad['serve_8']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->fruit_salad['serve_8']['price']*$data->byo_breakfast->fruit_salad['serve_8']['qty'],2)}}</td>
            </tr>
            @endif

        @endif

        @if (isset($data->byo_breakfast->sweet_treats) && $data->byo_breakfast->sweet_treats['total'] != 0)

            <tr class="first-item" style="font-size: 15px;">
                <td>Sweet Treats</td><td></td><td></td><td class="text-right"></td>
            </tr>

            @if ($data->byo_breakfast->sweet_treats['half_dozen']['qty'] != 0)

            <tr class="child-item">
            <td style="padding-left: 10px;font-size: 14px;"> - 1/2 Dozen</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sweet_treats['half_dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sweet_treats['half_dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sweet_treats['half_dozen']['qty']*$data->byo_breakfast->sweet_treats['half_dozen']['price'],2)}}</td>
            </tr>

            <tr class="sub-item" style="margin-top: 5px;">
                <td colspan="4" style="padding-left: 30px;">
                    @foreach ($data->byo_breakfast->sweet_treats['half_dozen']['list'] as $item)
                        @if (count($item) != 0)
                            <p class=""  style="font-size: 12px;">
                                <span class="sub-item-title" style="font-size: 12px; color: #f58220;">#{{$loop->count}}</span><br/>
                            @foreach ($item as $key => $value)
                                @if ($value != 0)
                                    {{ $data->byo_breakfast->sweet_treats_name[$key] }} : {{ $value }} <br/>
                                @endif 
                            @endforeach
                            </p>
                        @endif
                    @endforeach
                </td>
            </tr>

            @endif

            @if ($data->byo_breakfast->sweet_treats['dozen']['qty'] != 0)
            <tr class="child-item">
            <td style="padding-left: 10px;font-size: 14px;"> - Dozen</td><td class="text-center"style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sweet_treats['dozen']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sweet_treats['dozen']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sweet_treats['dozen']['price']*$data->byo_breakfast->sweet_treats['dozen']['qty'],2)}}</td>
            </tr>

            <tr class="sub-item" style="margin-top: 5px;">
                <td colspan="4" style="padding-left: 30px;">
                    @foreach ($data->byo_breakfast->sweet_treats['dozen']['list'] as $item)
                        @if (count($item) != 0)
                            <p class=""  style="font-size: 12px;">
                                <span class="sub-item-title" style="font-size: 12px; color: #f58220;">#{{$loop->count}}</span><br/>
                                @foreach ($item as $key => $value)
                                    @if ($value != 0)
                                        {{ $data->byo_breakfast->sweet_treats_name[$key] }} : {{ $value }} <br/>
                                    @endif 
                                @endforeach
                            </p>
                        @endif
                    @endforeach
                </td>
            </tr>
            @endif

        @endif

        @if (isset($data->byo_breakfast->sandwiches) && $data->byo_breakfast->sandwiches['total'] != 0)

            <tr class="first-item" style="font-size: 15px;">
                <td>Savory Breakfast Sandwiches</td><td></td><td></td><td class="text-right"></td>
            </tr>

            @if ($data->byo_breakfast->sandwiches['list']['zucchini'] != 0)
            <tr class="child-item" style="font-size: 14px;">
            <td style="padding-left: 10px; font-size:14px;"> - {{$data->byo_breakfast->sandwiches['list']['zucchini']['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sandwiches['list']['zucchini']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sandwiches['list']['zucchini']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sandwiches['list']['zucchini']['price']*$data->byo_breakfast->sandwiches['list']['zucchini']['qty'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->sandwiches['list']['sausage_bagel'] != 0)
            <tr class="child-item" style="font-size: 14px;">
            <td style="padding-left: 10px; font-size: 14px;"> - {{$data->byo_breakfast->sandwiches['list']['sausage_bagel']['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sandwiches['list']['sausage_bagel']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sandwiches['list']['sausage_bagel']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sandwiches['list']['sausage_bagel']['price']*$data->byo_breakfast->sandwiches['list']['sausage_bagel']['qty'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->sandwiches['list']['pepper_bagel'] != 0)
            <tr class="child-item" style="font-size: 14px;">
            <td style="padding-left: 10px; font-size: 14px;"> - {{$data->byo_breakfast->sandwiches['list']['pepper_bagel']['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sandwiches['list']['pepper_bagel']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sandwiches['list']['pepper_bagel']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sandwiches['list']['pepper_bagel']['price']*$data->byo_breakfast->sandwiches['list']['pepper_bagel']['qty'],2)}}</td>
            </tr>
            @endif

            @if ($data->byo_breakfast->sandwiches['list']['red_pepper_bagel'] != 0)
            <tr class="child-item" style="font-size: 14px;">
            <td style="padding-left: 10px;font-size: 14px;"> - {{$data->byo_breakfast->sandwiches['list']['red_pepper_bagel']['name']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">${{$data->byo_breakfast->sandwiches['list']['red_pepper_bagel']['price']}}</td><td class="text-center" style="font-size: 14px; text-align: right;">{{$data->byo_breakfast->sandwiches['list']['red_pepper_bagel']['qty']}}</td><td class="text-right" style="font-size: 14px; text-align: right;">${{round($data->byo_breakfast->sandwiches['list']['red_pepper_bagel']['price']*$data->byo_breakfast->sandwiches['list']['red_pepper_bagel']['qty'],2)}}</td>
            </tr>
            @endif

        @endif

        <tr class="od-footer" style="border-top: 1px solid #c8942b;">
            <td  style="border-top: 1px solid #c8942b;" colspan="3"></td><td class="text-right"  style="border-top: 1px solid #c8942b; text-align: right;">${{$data->byo_breakfast->total}}</td>
        </tr>

    </tbody></table>
    <table class="spacer"><tbody><tr><td height="26px" style="font-size:20px;line-height:20px;">&nbsp;</td></tr></tbody></table>
    @endif