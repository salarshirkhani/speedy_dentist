@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('lab-report-create')
                    <h3>
                        <a href="{{ route('lab-reports.create') }}" class="btn btn-outline btn-info">+ @lang('Lab Report')</a>
                        <span class="pull-right"></span>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">@lang('Lab Report List')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Lab Report List')</h3>
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
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>@lang('Report Date')</label>
                                        <input type="text" name="date" class="form-control flatpickr" value="{{ request()->date }}" placeholder="@lang('Report Date')">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ request()->name }}" placeholder="@lang('Name')">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>@lang('Email')</label>
                                        <input type="text" name="email" class="form-control" value="{{ request()->email }}" placeholder="@lang('Email')">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>@lang('Phone')</label>
                                        <input type="text" name="phone" class="form-control" value="{{ request()->phone }}" placeholder="@lang('Phone')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('lab-reports.index') }}" class="btn btn-secondary">@lang('Clear')</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('Report Date')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Phone')</th>
                            <th data-orderable="false">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labReports as $labReport)
                        <tr>
                            <td>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($labReport->date)) }}</td>
                            <td>{{ $labReport->user->name }}</td>
                            <td>{{ $labReport->user->email }}</td>
                            <td>{{ $labReport->user->phone }}</td>
                            <td>
                                <a href="{{ route('lab-reports.show', $labReport) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @can('lab-report-update')
                                    <a href="{{ route('lab-reports.edit', $labReport) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endcan
                                @can('lab-report-delete')
                                    <a href="#" data-href="{{ route('lab-reports.destroy', $labReport) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $labReports->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
