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
            </div>
            <div class="card-body">
                <form id="scheduleForm" class="form-material form-horizontal" action="{{ route('doctor-schedules.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_id">@lang('Select Doctor') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required>
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('user_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
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
                            <label for="weekday">@lang('Select Weekday') <b class="ambitious-crimson">*</b></label>
                            <div class="form-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                </div>
                                <select name="weekday" class="form-control @error('weekday') is-invalid @enderror" id="weekday" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach (config('constant.weekdays') as $weekday)
                                        <option value="{{ $weekday }}" {{ old('weekday') == $weekday ? 'selected' : '' }}>@lang($weekday)</option>
                                    @endforeach
                                </select>
                                @error('weekday')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_time">@lang('Start Time') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="start_time" id="start_time" class="form-control flatpickr-pick-time @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_time">@lang('End Time') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="end_time" id="end_time" class="form-control flatpickr-pick-time @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
                                    @error('end_time')
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
                                <label for="avg_appointment_duration">@lang('Avg Appointment Duration') (@lang('minute')) <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                    </div>
                                    <select class="form-control @error('avg_appointment_duration') is-invalid @enderror" name="avg_appointment_duration" id="avg_appointment_duration" required>
                                        @foreach (config('constant.avg_appointment_durations') as $duration)
                                            <option value="{{ $duration }}" {{ old('avg_appointment_duration') == $duration ? 'selected' : '' }}>{{ $duration }}</option>
                                        @endforeach
                                    </select>
                                    @error('avg_appointment_duration')
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
                                <label for="serial_type">@lang('Serial Type') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-center"></i></span>
                                    </div>
                                    <select class="form-control @error('serial_type') is-invalid @enderror" name="serial_type" id="serial_type" required>
                                        <option value="Sequential" {{ old('serial_type') == 'Sequential' ? 'selected' : '' }}>@lang('Sequential')</option>
                                        <option value="Timestamp" {{ old('serial_type') == 'Timestamp' ? 'selected' : '' }}>@lang('Timestamp')</option>
                                    </select>
                                    @error('serial_type')
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
                                <label for="status">@lang('Status') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                    </div>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                                        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>@lang('Active')</option>
                                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>@lang('Inactive')</option>
                                    </select>
                                    @error('status')
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
                            <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('doctor-schedules.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
