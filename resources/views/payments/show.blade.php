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
                        <a href="{{ route('payments.index') }}">@lang('Payment')</a></li>
                    <li class="breadcrumb-item active">@lang('Payment Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Payment Info')</h3>
                <div class="card-tools">
                    @can('payment-update')
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-info">@lang('Edit')</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="payment_date">@lang('Payment Date')</label>
                            <p>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($payment->payment_date)) }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="receiver_name">@lang('Receiver Name')</label>
                            <p>{{ $payment->receiver_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account_name">@lang('Account Name')</label>
                            <p>{{ $payment->account_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 description_padding_left">
                        <div class="form-group">
                            <label for="description" class="col-md-12 col-form-label">@lang('Description')</label>
                            <div class="description_padding_left_e">{!! str_replace(["script"], ["noscript"], $payment->description) !!}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="amount">@lang('Amount')</label>
                            <p>{{ $payment->amount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
