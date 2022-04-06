@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">@lang('Report')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Report')</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" target="_blank" href="{{ route('financial-reports.index') }}?export=1"><i class="fas fa-cloud-download-alt"></i> @lang('Export')</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('financial-reports.index') }}" method="get">
                        <div class="row border">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>@lang('Date From')</label>
                                    <input type="text" name="date_from" id="date_from" class="form-control flatpickr" placeholder="@lang('Date From')" value="{{ old('date_from', request()->date_from) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>@lang('Date To')</label>
                                    <input type="text" name="date_to" id="date_to" class="form-control flatpickr" placeholder="@lang('Date To')" value="{{ old('date_to', request()->date_to) }}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">@lang('Submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>@lang('Credit')</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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
                                                <td>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($credit->payment_date)) }}</td>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>@lang('Debit')</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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
                                                <td>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($debits->invoice->invoice_date)) }}</td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
