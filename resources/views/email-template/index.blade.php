@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('sms-template-create')
                    <h3><a href="{{ route('email-templates.create') }}" class="btn btn-outline btn-info">+ @lang('Email Template')</a>
                        <span class="pull-right"></span>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">@lang('Email Template List')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Email Template List')</h3>
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
                                        <label>@lang('Name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ request()->name }}" placeholder="@lang('Name')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('email-templates.index') }}" class="btn btn-secondary">@lang('Clear')</a>
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
                            <th>@lang('Template Name')</th>
                            <th data-orderable="false">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emailTemplates as $emailTemplate)
                        <tr>
                            <td>{{ $emailTemplate->id }}</td>
                            <td>{{ $emailTemplate->name }}</td>
                            <td>
                                <a href="{{ route('email-templates.show', $emailTemplate) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @can('email-template-update')
                                    <a href="{{ route('email-templates.edit', $emailTemplate) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endcan
                                @can('email-template-delete')
                                    <a href="#" data-href="{{ route('email-templates.destroy', $emailTemplate) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $emailTemplates->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
