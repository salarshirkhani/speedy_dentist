@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('doctor-schedule-create')
                    <h3>
                        <a href="{{ route('doctor-schedules.create') }}" class="btn btn-outline btn-info">+ @lang('Add Schedule')</a>
                        <span class="pull-right"></span>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">@lang('Doctor Schedule')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>@lang('Doctor Schedule')</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Doctor Name')</th>
                            <th>@lang('Weekday')</th>
                            <th>@lang('Visiting Time')</th>
                            <th>@lang('Status')</th>
                            <th data-orderable="false">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctorSchedules as $doctorSchedule)
                            <tr>
                                <td>{{ $doctorSchedule->id }}</td>
                                <td>{{ $doctorSchedule->user->name }}</td>
                                <td>{{ $doctorSchedule->weekday }}</td>
                                <td>{{ $doctorSchedule->start_time . ' - ' . $doctorSchedule->end_time }}</td>
                                <td>
                                    @if($doctorSchedule->status == '1')
                                        <span class="badge badge-pill badge-success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">@lang('Inactive')</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('doctor-schedules.show', $doctorSchedule) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                    @can('doctor-schedule-update')
                                        <a href="{{ route('doctor-schedules.edit', $doctorSchedule) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                    @endcan
                                    @can('doctor-schedule-delete')
                                        <a href="#" data-href="{{ route('doctor-schedules.destroy', $doctorSchedule) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $doctorSchedules->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
