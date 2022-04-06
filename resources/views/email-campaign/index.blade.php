@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('email-template-create')
                    <h3><a href="{{ route('email-campaigns.create') }}" class="btn btn-outline btn-info">+ @lang('Email Campaign')</a>
                        <span class="pull-right"></span>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">@lang('Email Campaign List')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Email Campaign List')</h3>
                <div class="card-tools">
                    <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                </div>
            </div>
            <div class="card-body">
                <div id="filter" class="collapse @if(request()->isFilterActive) show @endif">
                    <div class="card-body border">
                        <form action="" method="get" role="form" autocomplete="off">
                            <input type="hidden" name="isFilterActive" value="true">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>@lang('campaign Name')</label>
                                        <input type="text" name="campaign_name" class="form-control" value="{{ request()->campaign_name }}" placeholder="@lang('Name')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('email-campaigns.index') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('Campaign Name')</th>
                            <th>@lang('Contact Type')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Scheduled at')</th>
                            <th>@lang('Created at')</th>
                            <th data-orderable="false">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emailCampaigns as $emailCampaign)
                        <tr>
                            <td>{{ $emailCampaign->campaign_name }}</td>
                            <td>{{ $emailCampaign->contact_type}}</td>
                            <td>
                                @if ($emailCampaign->status == 'Pending')
                                    <h4><span class="badge badge-secondary">@lang('Pending')</span></h4>
                                @elseif ($emailCampaign->status == 'Processing')
                                    <h4><span class="badge badge-warning">@lang('Processing')</span></h4>
                                @elseif ($emailCampaign->status == 'Completed')
                                    <h4><span class="badge badge-success">@lang('Completed')</span></h4>
                                @else
                                    <h4><span class="badge badge-danger">@lang('Failed')</span></h4>
                                @endif
                            </td>
                            <td>
                                {{ date($companySettings->date_format.' H:i:s' ?? 'Y-m-d H:i:s', strtotime($emailCampaign->schedule_time)) }}
                            </td>
                            <td>
                                {{ date($company->date_format ?? 'Y-m-d', strtotime($emailCampaign->created_at)) }}
                            </td>
                            <td>
                                @if($emailCampaign->status == 'Completed')
                                    <a href="{{ route('email-campaigns.show', $emailCampaign) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-list ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" data-href="{{ route('email-campaigns.destroy', $emailCampaign) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $emailCampaigns->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
