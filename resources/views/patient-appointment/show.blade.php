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
                        <a href="{{ route('patient-appointments.index') }}">@lang('Patient Appointment')</a></li>
                    <li class="breadcrumb-item active">@lang('Patient Appointment Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Patient Appointment Info')</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">@lang('Patient Name')</label>
                            <p>{{ $patientAppointment->user->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doctor_id">@lang('Doctor Name')</label>
                            <p>{{ $patientAppointment->doctor->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_date">@lang('Appointment Date')</label>
                            <p>{{ $patientAppointment->appointment_date }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_slot">@lang('Appointment Time')</label>
                            <p>{{ $patientAppointment->start_time.' - '.$patientAppointment->end_time }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="problem">@lang('Problem')</label>
                            <p>{{ $patientAppointment->problem }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
