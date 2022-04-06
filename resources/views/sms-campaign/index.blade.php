@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('sms-template-create')
                    <h3><a href="{{ route('sms-campaigns.create') }}" class="btn btn-outline btn-info">+ @lang('SMS Campaign')</a>
                        <span class="pull-right"></span>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active">@lang('SMS Campaign List')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('SMS Campaign List')</h3>
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
                                        <label>@lang('Campaign Name')</label>
                                        <input type="text" name="campaign_name" class="form-control" value="{{ request()->campaign_name }}" placeholder="@lang('Name')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('sms-campaigns.index') }}" class="btn btn-secondary">@lang('Clear')</a>
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
                        @foreach ($smsCampaigns as $smsCampaign)
                        <tr>
                            <td>{{ $smsCampaign->campaign_name }}</td>
                            <td>{{ $smsCampaign->contact_type}}</td>
                            <td>
                                @if ($smsCampaign->status == 'Pending')
                                    <h4><span class="badge badge-secondary">@lang('Pending')</span></h4>
                                @elseif ($smsCampaign->status == 'Processing')
                                    <h4><span class="badge badge-warning">@lang('Processing')</span></h4>
                                @elseif ($smsCampaign->status == 'Completed')
                                    <h4><span class="badge badge-success">@lang('Completed')</span></h4>
                                @else
                                    <h4><span class="badge badge-danger">@lang('Failed')</span></h4>
                                @endif
                            </td>
                            <td>
                                {{ date($companySettings->date_format.' H:i:s' ?? 'Y-m-d H:i:s', strtotime($smsCampaign->schedule_time)) }}
                            </td>
                            <td>
                                {{ date($companySettings->date_format ?? 'Y-m-d', strtotime($smsCampaign->created_at)) }}
                            </td>
                            <td>
                                @if($smsCampaign->status == 'Completed')
                                <a href="{{ route('sms-campaigns.show', $smsCampaign) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-list ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" data-href="{{ route('sms-campaigns.destroy', $smsCampaign) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $smsCampaigns->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
