@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @can('payment-create')
                        <h3><a href="{{ route('payments.create') }}" class="btn btn-outline btn-info">+ @lang('Add Payment')</a>
                            <span class="pull-right"></span>
                        </h3>
                    @endcan
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">@lang('Payment')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Payment List')</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" target="_blank" href="{{ route('payments.index') }}?export=1"><i class="fas fa-cloud-download-alt"></i> @lang('Export')</a>
                        <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="filter" class="collapse @if(request()->isFilterActive) show @endif">
                        <div class="card-body border">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Account Name')</label>
                                            <select class="form-control select2" name="account_name" id="account_name">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($accountHeaders as $accountHeader)
                                                    <option value="{{ $accountHeader->name }}" @if(request()->account_name == $accountHeader->name) selected @endif>{{ $accountHeader->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Receiver Name')</label>
                                            <input type="text" id="receiver_name" name="receiver_name" value="{{ request()->receiver_name }}" class="form-control" placeholder="@lang('Receiver Name')">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Payment Date')</label>
                                            <input type="text" id="payment_date" name="payment_date" value="{{ request()->payment_date }}" class="form-control flatpickr" placeholder="@lang('Payment Date')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                        @if(request()->isFilterActive)
                                            <a href="{{ route('payments.index') }}" class="btn btn-secondary">@lang('Clear')</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-striped" id="laravel_datatable">
                        <thead>
                            <tr>
                                <th>@lang('ID')</th>
                                <th>@lang('Account Name')</th>
                                <th>@lang('Receiver Name')</th>
                                <th>@lang('Account Type')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Payment Date')</th>
                                <th>@lang('Actions')</th>
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
                                    <td>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($payment->payment_date)) }}</td>
                                    <td>
                                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                        @can('payment-update')
                                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                        @endcan
                                        @can('payment-delete')
                                            <a href="#" data-href="{{ route('payments.destroy', $payment) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $payments->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@include('layouts.delete_modal')
@endsection
