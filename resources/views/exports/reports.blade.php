<table>
    <thead>
        <tr>
            <td colspan="3">Credit</td>
        </tr>
        <tr>
            <th>@lang('Account Name')</th>
            <th>@lang('Receiver Name')</th>
            <th>@lang('Date')</th>
            <th>@lang('Grand Total')</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalCredit = 0;
        @endphp
        @foreach ($credits as $credit)
            <tr>
                <td>{{ $credit->account_name }}</td>
                <td>{{ $credit->receiver_name }}</td>
                <td>{{ $credit->payment_date }}</td>
                <td>{{ $credit->amount }}</td>
            </tr>
            @php
                $totalCredit += $credit->amount;
            @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <th>@lang('Total')</th>
            <th>{{ $totalCredit }}</th>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <td colspan="3">Debit</td>
        </tr>
        <tr>
            <th>@lang('Account Name')</th>
            <th>@lang('Patient Name')</th>
            <th>@lang('Date')</th>
            <th>@lang('Grand Total')</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalDebit = 0;
        @endphp
        @foreach ($debits as $debits)
            <tr>
                <td>{{ $debits->account_name }}</td>
                <td>{{ $debits->invoice->user->name }}</td>
                <td>{{ $debits->invoice->invoice_date }}</td>
                <td>{{ $debits->total }}</td>
            </tr>
            @php
                $totalDebit += $debits->total;
            @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <th>@lang('Total')</th>
            <th>{{ $totalDebit }}</th>
        </tr>
    </tbody>
</table>
