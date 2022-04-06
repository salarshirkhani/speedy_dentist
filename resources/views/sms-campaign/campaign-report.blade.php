@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('sms-campaigns.index') }}">@lang('SMS Campaign')</a></li>
                    <li class="breadcrumb-item active">@lang('SMS Campaign Report')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('SMS Campaign Report List')</h3>
                <div class="card-tools">
                    <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Phone')</th>
                            <th>@lang('Delivery Id')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Created at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($smsCampaignReports as $smsCampaignReport)
                        <tr>
                            <td> {{ $smsCampaignReport->user->name }}</td>
                            <td> {{ $smsCampaignReport->user->phone }}</td>
                            <td> {{ $smsCampaignReport->delivery_id }}</td>
                            <td>
                                @if($smsCampaignReport->status == 1)
                                    <h4><span class="badge badge-success">@lang('Send')</span></h4>
                                @else
                                    <h4><span class="badge badge-warning">@lang('Not Send')</span></h4>
                                @endif
                            </td>
                            <td>
                                {{ date('d-m-Y H:i:s', strtotime($smsCampaignReport->created_at)) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $smsCampaignReports->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
