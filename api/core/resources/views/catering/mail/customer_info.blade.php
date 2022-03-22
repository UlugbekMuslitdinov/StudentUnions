<table  class="small-12 large-12 columns callout" style="width: 100%"><tbody><tr><th class="" style="padding: 0px;">
    <table class="row"><tbody><tr>
        <th class="small-12 large-6 columns first"><table><tbody><tr><th>
            <p style="text-align: left;">
                <strong>Order ID</strong><br>
                {{ $data->customer_info->id ?? '' }}
            </p>
            <p style="text-align: left;">
                <strong>Name</strong><br>
                {{ $data->customer_info->customer_name ?? '' }}
            </p>
            <p style="text-align: left;">
                <strong>Phone</strong><br>
                {{ $data->customer_info->customer_phone ?? '' }}
            </p>
            <p style="text-align: left;">
                <strong>Email Address</strong><br>
                {{ $data->customer_info->customer_email ?? '' }}
            </p>
            <p style="text-align: left;">
                <strong>Payment Method</strong><br>
                {{ $data->customer_info->payment_method ?? '' }}

                @isset($data->customer_info->payment_method)
                    @if ($data->customer_info->payment_method == 'IDB')
                        <br>
                        - Account Number: {{ $data->customer_info->account_num ?? '' }}<br>
                        - Sub Code: {{ $data->customer_info->sub_code ?? '' }}
                    @endif
                @endif
            </p>
        </th></tr></tbody></table></th>
        <th class="small-12 large-6 columns last"><table><tbody><tr><th>
            <p style="text-align: left;">
                <strong>Delivery Method</strong><br>
                {{ $data->customer_info->method ?? '' }}
            </p>
            <p style="text-align: left;">
                <strong>Delivery Date</strong><br>
                @isset($data->customer_info->delivery_date)
                    {{ date("m/d/Y", strtotime($data->customer_info->delivery_date)) }}
                @endisset
            </p>
            <p style="text-align: left;">
                <strong>Delivery Time</strong><br>
                @isset($data->customer_info->delivery_time)
                    {{ $data->customer_info->delivery_time }}
                @endisset
            </p>
            @isset($data->customer_info->method)
                @if ($data->customer_info->method == 'Delivery')
                    <p style="text-align: left;">
                        <strong>Delivery Building</strong><br>
                        {{ $data->customer_info->delivery_building ?? '' }}
                    </p>
                    <p style="text-align: left;">
                        <strong>Delivery Room</strong><br>
                        {{ $data->customer_info->delivery_room ?? '' }}
                    </p>
                    <p style="text-align: left;">
                        <strong>On-site Contact</strong><br>
                        {{ $data->customer_info->onsite_name ?? '' }}
                    </p>
                    <p style="text-align: left;">
                        <strong>On-site Email</strong><br>
                        {{ $data->customer_info->onsite_email ?? '' }}
                    </p>
                    <p style="text-align: left;">
                        <strong>On-site Phone</strong><br>
                        {{ $data->customer_info->onsite_phone ?? '' }}
                    </p>
                @endif
            @endisset

            <p style="text-align: left;">
                <strong>Delivery Note</strong><br>
                {{ $data->customer_info->delivery_notes ?? '' }}
            </p>
            
        </th></tr></tbody></table>
    </th></tr></tbody></table>
</th></tr></tbody></table>