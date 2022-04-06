@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('invoices.index') }}">@lang('Invoice')</a></li>
                    <li class="breadcrumb-item active">@lang('Invoice Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Invoice Info')</h3>
                <div class="card-tools">
                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-info">@lang('Edit')</a>
                    <button id="doPrint" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
            <div id="print-area" class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img src="{{ $company->company_logo }}" class="custom-wi-he" alt=""> {{ $company->company_name }}
                                    </h4>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    @lang('From')
                                    <address>
                                        <strong>{{ $company->company_name }}</strong><br>
                                        @if ($company->company_address)
                                            {!! str_replace(["script"], ["noscript"], $company->company_address) !!}
                                        @endif
                                        @lang('Email'): {{ $company->company_email }}<br>
                                        @if ($company->company_phone)
                                            @lang('Phone'): {{ $company->company_phone }}
                                        @endif
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    @lang('To')
                                    <address>
                                        <strong>{{ $invoice->user->name }}</strong><br />
                                        @if ($invoice->user->address)
                                            {!! nl2br(str_replace(["script"], ["noscript"], $invoice->user->address)) !!}<br>
                                        @endif
                                        @lang('Email'): {{ $invoice->user->email }}<br>
                                        @if ($invoice->user->phone)
                                            @lang('Phone'): {{ $invoice->user->phone }}
                                        @endif
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    @lang('Invoice') #{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}<br>
                                    @lang('Date'): {{ date($companySettings->date_format ?? 'Y-m-d', strtotime($invoice->invoice_date)) }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="custom-th-width-20">@lang('Account Name')</th>
                                                <th scope="col" class="custom-th-width-25">@lang('Description')</th>
                                                <th scope="col">@lang('Quantity')</th>
                                                <th scope="col">@lang('Price')</th>
                                                <th scope="col" class="custom-th-width-15">@lang('Sub Total')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->invoiceItems as $invoiceItem)
                                                <tr>
                                                    <td>{{ $invoiceItem->account_name }}</td>
                                                    <td>{{ $invoiceItem->description }}</td>
                                                    <td>{{ $invoiceItem->quantity }}</td>
                                                    <td>{{ $invoiceItem->price }}</td>
                                                    <td>{{ $invoiceItem->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-md-6">
                                    <p class="lead">@lang('Insurance'): {{ $invoice->insurance->name ?? 'N/A' }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>@lang('Total')</th>
                                                    <td>{{ $invoice->total }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Discount') ({{ $invoice->discount_percentage }}%)</th>
                                                    <td>{{ $invoice->total_discount }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Vat') ({{ $invoice->vat_percentage }}%)</th>
                                                    <td>{{ $invoice->total_vat }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Grand Total')</th>
                                                    <td>{{ $invoice->grand_total }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Paid')</th>
                                                    <td>{{ $invoice->paid }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('Due')</th>
                                                    <td>{{ $invoice->due }}</td>
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
        </div>
    </div>
</div>
@endsection
