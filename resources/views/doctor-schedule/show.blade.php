@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('doctor-schedules.index') }}">@lang('Doctor Schedule')</a></li>
                    <li class="breadcrumb-item active">@lang('Add Doctor Schedule')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Doctor Schedule')</h3>
                @can('doctor-schedule-update')
                    <div class="card-tools">
                        <a href="{{ route('doctor-schedules.edit', $doctorSchedule) }}" class="btn btn-info">@lang('Edit')</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">@lang('Doctor Name')</label>
                            <p>{{ $doctorSchedule->user->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weekday">@lang('Weekday')</label>
                            <p>{{ $doctorSchedule->weekday }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_time">@lang('Start Time')</label>
                            <p>{{ $doctorSchedule->start_time }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_time">@lang('End Time')</label>
                            <p>{{ $doctorSchedule->end_time }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="avg_appointment_duration">@lang('Avg Appointment Duration')</label>
                            <p>{{ $doctorSchedule->avg_appointment_duration }} @lang('minutes')</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="serial_type">@lang('Serial Type')</label>
                            <p>{{ $doctorSchedule->serial_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">@lang('Status')</label>
                            <p>
                                @if($doctorSchedule->status == '1')
                                    <span class="badge badge-pill badge-success">@lang('Active')</span>
                                @else
                                    <span class="badge badge-pill badge-danger">@lang('Inactive')</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
