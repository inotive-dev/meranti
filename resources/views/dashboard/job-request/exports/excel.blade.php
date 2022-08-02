<table style="width: 100%; border: 1px solid #000" cellpadding="6" cellspacing="0">
    <tbody>
        <tr>
            <td style="font-size: 18px; font-weight: bold" colspan="2">
                JOB REQUEST
            </td>
            <td colspan="3" rowspan="4" style="text-align: center; vertical-align: bottom">
                <img src="{{ public_path() }}/assets/images/logo-meranti.png">
            </td>
        </tr>
        <tr>
            <td>Number</td>
            <td>: {{ $job_request->number }}</td>
        </tr>
        <tr>
            <td>Revision</td>
            <td>: {{ $job_request->revision }}</td>
        </tr>
        <tr>
            <td>Project</td>
            <td>: {{ $job_request->project->name }}</td>
        </tr>
        <tr>
            <td>Owner</td>
            <td>: {{ $job_request->project->client->name }}</td>
            <td style="text-align: center" colspan="3">PT. MERANTI NUSA BAHARI</td>
        </tr>
        <tr>
            <td>Reference</td>
            <td>: {{ $job_request->reference }}</td>
            <td style="text-align: center" colspan="3">Integrity , Trustworthy , Synergy</td>
        </tr>
        <tr>
            <td colspan="5" style="height: 32px"></td>
        </tr>
        <tr>
            <th style="border: 1px solid #000">No</th>
            <th style="border: 1px solid #000">Item</th>
            <th style="border: 1px solid #000">Volume</th>
            <th style="border: 1px solid #000">Remarks</th>
            <th style="border: 1px solid #000">Status</th>
        </tr>
        @foreach($job_request_items as $key => $job_request_item)
            <tr>
                <th style="border: 1px solid #000">
                    <ol style="list-style-type: upper-roman;" start="{{ $key + 1 }}">
                        <li></li>
                    </ol>
                </th>
                <th style="border: 1px solid #000" class="{{ $job_request_item->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_item->remarks == 3 ? 'bg-danger' : '' }}">{{ $job_request_item->name }}</th>
                <th style="border: 1px solid #000">{{ $job_request_item->volume . ' ' . $job_request_item->unit }}</th>
                <th style="border: 1px solid #000">{{ $job_request_item->remarks_reason }}</th>
                <th style="border: 1px solid #000">{{ $job_request_item->status }}</th>
            </tr>
            @foreach($job_request_item->job_request_item_childs as $key2 => $job_request_child)
                <tr>
                    <td style="border: 1px solid #000" class="pe-0">
                        <ol class="text-right pe-0 me-0" style="list-style-type: lower-alpha;" start="{{ $key2 + 1 }}">
                            <li style="width: 0px"></li>
                        </ol>
                    </td>
                    <td style="border: 1px solid #000" class="{{ $job_request_child->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_child->remarks == 3 ? 'bg-danger' : '' }}">{{ $job_request_child->name }}</td>
                    <td style="border: 1px solid #000">{{ $job_request_child->volume . ' ' . $job_request_child->unit }}</td>
                    <td style="border: 1px solid #000">{{ $job_request_child->remarks_reason }}</td>
                    <th style="border: 1px solid #000">{{ $job_request_item->status }}</th>
                </tr>
                @foreach($job_request_child->job_request_item_childs as $key3 => $job_request_sub_child)
                    <tr>
                        <td style="border: 1px solid #000" class="pe-0">
                        </td>
                        <td style="border: 1px solid #000"> 
                            <ul class="sub3 {{ $job_request_sub_child->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_sub_child->remarks == 3 ? 'bg-danger' : '' }}">
                                <li>{{ $job_request_sub_child->name }}</li>
                            </ul>
                        </td>
                        <td style="border: 1px solid #000">{{ $job_request_sub_child->volume . ' ' . $job_request_sub_child->unit }}</td>
                        <td style="border: 1px solid #000">{{ $job_request_sub_child->remarks_reason }}</td>
                        <th style="border: 1px solid #000">{{ $job_request_item->status }}</th>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
</table>