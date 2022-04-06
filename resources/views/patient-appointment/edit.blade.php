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
                    <li class="breadcrumb-item active">@lang('Edit Patient Appointment')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Edit Patient Appointment')</h3>
            </div>
            <div class="card-body">
                <form id="scheduleForm" class="form-material form-horizontal" action="{{ route('patient-appointments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_id">@lang('Select Patient') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                    </div>
                                    <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required>
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}" {{ old('user_id', $patientAppointment->user_id) == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doctor_id">@lang('Select Doctor') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                    </div>
                                    <select name="doctor_id" class="form-control select2 @error('doctor_id') is-invalid @enderror" id="doctor_id" required>
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id', $patientAppointment->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_date">@lang('Appointment Date') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                    </div>
                                    <input type="text" name="appointment_date" id="appointment_date" class="form-control flatpickr @error('appointment_date') is-invalid @enderror" placeholder="@lang('Appointment Date')" value="{{ old('appointment_date', $patientAppointment->appointment_date) }}">
                                    @error('appointment_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_slot">@lang('Available Appointment Slots') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                    </div>
                                    <select class="form-control @error('appointment_slot') is-invalid @enderror" name="appointment_slot" id="appointment_slot" required>
                                    </select>
                                    @error('appointment_slot')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="problem">@lang('Problem')</label>
                                <div class="input-group mb-3">
                                    <textarea name="problem" id="problem" class="form-control @error('problem') is-invalid @enderror" rows="4" placeholder="@lang('Problem')">{{ old('problem', $patientAppointment->problem) }}</textarea>
                                    @error('problem')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" value="{{ __('entire.submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('patient-appointments.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('currency.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/patient-appointment.js') }}"></script>
@endpush
