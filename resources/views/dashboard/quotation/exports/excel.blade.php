<table style="width: 100%; border: 1px solid #000" cellspacing="0">
<tbody>
    <tr>
        <th style="text-align: center; border: 1px solid #000">No</th>
        <th style="text-align: center; border: 1px solid #000">Item</th>
        <th style="text-align: center; border: 1px solid #000">Volume</th>
        <th style="text-align: center; border: 1px solid #000">Unit Price</th>
        <th style="text-align: center; border: 1px solid #000">Service</th>
        <th style="text-align: center; border: 1px solid #000">Material</th>
        <th style="text-align: center; border: 1px solid #000">Status</th>
    </tr>
    @foreach($quotation_items as $key => $quotation_item)
        <tr>
            <th style="border: 1px solid #000">
                <ol style="list-style-type: upper-roman;" start="{{ $key + 1 }}">
                    <li></li>
                </ol>
            </th>
            <th style="border: 1px solid #000" class="{{ $quotation_item->job_request_item->remarks == 2 ? 'bg-warning' : '' }}{{ $quotation_item->job_request_item->remarks == 3 ? 'bg-danger' : '' }}">{{ $quotation_item->name }}</th>
            <th style="border: 1px solid #000">{{ $quotation_item->volume }}</th>
            <th style="border: 1px solid #000">{{ $quotation_item->unit_price }}</th>
            <th style="border: 1px solid #000">{{ $quotation_item->service }}</th>
            <th style="border: 1px solid #000">{{ $quotation_item->material }}</th>
            <th style="border: 1px solid #000">{{ $quotation_item->status }}</th>
        </tr>
        @foreach($quotation_item->quotation_item_childs as $key2 => $quotation_item_child)
            <tr>
                <td style="border: 1px solid #000">
                    <ol class="text-right pe-0 me-0" style="list-style-type: lower-alpha;" start="{{ $key2 + 1 }}">
                        <li style="width: 0px"></li>
                    </ol>
                </td>
                <td style="border: 1px solid #000" class="{{ $quotation_item_child->job_request_item->remarks == 2 ? 'bg-warning' : '' }}{{ $quotation_item_child->job_request_item->remarks == 3 ? 'bg-danger' : '' }}">{{ $quotation_item_child->name }}</td>
                <td style="border: 1px solid #000">{{ $quotation_item_child->volume }}</td>
                <td style="border: 1px solid #000">{{ $quotation_item_child->unit_price }}</td>
                <td style="border: 1px solid #000">{{ $quotation_item_child->service }}</td>
                <td style="border: 1px solid #000">{{ $quotation_item_child->material }}</td>
                <th style="border: 1px solid #000">{{ $quotation_item->status }}</th>
            </tr>
            @foreach($quotation_item_child->quotation_item_childs as $key3 => $quotation_item_sub_child)
                <tr>
                    <td style="border: 1px solid #000">
                    </td>
                    <td style="border: 1px solid #000">
                        <ul class="sub3 {{ $quotation_item_sub_child->job_request_item->remarks == 2 ? 'bg-warning' : '' }}{{ $quotation_item_sub_child->job_request_item->remarks == 3 ? 'bg-danger' : '' }}">
                            <li>{{ $quotation_item_sub_child->name }}</li>
                        </ul>
                    </td>
                    <td style="border: 1px solid #000">{{ $quotation_item_sub_child->volume }}</td>
                    <td style="border: 1px solid #000">{{ $quotation_item_sub_child->unit_price }}</td>
                    <td style="border: 1px solid #000">{{ $quotation_item_sub_child->service }}</td>
                    <td style="border: 1px solid #000">{{ $quotation_item_sub_child->material }}</td>
                    <th style="border: 1px solid #000">{{ $quotation_item->status }}</th>
                </tr>
            @endforeach
        @endforeach
    @endforeach
</tbody>
</table>