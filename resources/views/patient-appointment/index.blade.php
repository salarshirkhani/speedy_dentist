@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @can('patient-appointment-create')
                        <h3>
                            <a href="{{ route('patient-appointments.create') }}" class="btn btn-outline btn-info">+ @lang('Patient Appointment')</a>
                            <span class="pull-right"></span>
                        </h3>
                    @endcan
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">@lang('Patient Appointment')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Patient Appointment')</h3>
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Patient')</label>
                                            <select name="user_id" class="form-control select2" id="user_id">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->id }}" {{ old('user_id', request()->user_id) == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Doctor')</label>
                                            <select name="doctor_id" class="form-control select2" id="doctor_id">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', request()->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('Appointment Date')</label>
                                            <input type="text" name="appointment_date" id="appointment_date" class="form-control flatpickr" placeholder="@lang('Appointment Date')" value="{{ old('appointment_date', request()->appointment_date) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                        @if(request()->isFilterActive)
                                            <a href="{{ route('patient-appointments.index') }}" class="btn btn-secondary">@lang('Clear')</a>
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
                                <th>@lang('Doctor Name')</th>
                                <th>@lang('Patient Name')</th>
                                <th>@lang('Appointment Date')</th>
                                <th>@lang('Appointment Time')</th>
                                <th data-orderable="false">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientAppointments as $patientAppointment)
                                <tr>
                                    <td>{{ $patientAppointment->id }}</td>
                                    <td>{{ $patientAppointment->doctor->name }}</td>
                                    <td>{{ $patientAppointment->user->name }}</td>
                                    <td>{{ date($companySettings->date_format, strtotime($patientAppointment->appointment_date)) }}</td>
                                    <td>{{ $patientAppointment->start_time . ' - ' . $patientAppointment->end_time }}</td>
                                    <td>
                                        <a href="{{ route('patient-appointments.show', $patientAppointment) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                        @can('doctor-schedule-delete')
                                            <a href="#" data-href="{{ route('patient-appointments.destroy', $patientAppointment) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $patientAppointments->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@include('layouts.delete_modal')
@endsection
