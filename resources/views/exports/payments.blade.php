<table class="table table-striped" id="laravel_datatable">
    <thead>
        <tr>
            <th>@lang('ID')</th>
            <th>@lang('Account Name')</th>
            <th>@lang('Receiver Name')</th>
            <th>@lang('Account Type')</th>
            <th>@lang('Amount')</th>
            <th>@lang('Payment Date')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->account_name }}</td>
                <td>{{ $payment->receiver_name }}</td>
                <td>{{ $payment->account_type }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->payment_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>