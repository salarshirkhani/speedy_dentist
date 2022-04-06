@extends('layouts.layout')

@push('header')
    <meta name="warning-patient-first" content="{{ __("Select Patient First") }}">
    <meta name="warning-report-date" content="{{ __("Select Lab Report Date") }}">
    <meta name="warning-template-first" content="{{ __("Select Lab Report Template First") }}">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lab-reports.index') }}">@lang('Lab Report')</a></li>
                    <li class="breadcrumb-item active">@lang('Add Lab Report')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Lab Report')</h3>
            </div>
            <div class="card-body">
                <form id="labReportFrom" class="form-material form-horizontal" action="{{ route('lab-reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">@lang('Date') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                    </div>
                                    <input type="text" name="date" id="date" class="form-control today-flatpickr generate_report_template @error('date') is-invalid @enderror" placeholder="@lang('Date')" value="{{ old('date') }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_id">@lang('Select Patient') <b class="ambitious-crimson">*</b></label>
                                <select name="patient_id" id="patient_id" class="form-control select2 custom-width-100 generate_report_template @error('patient_id') is-invalid @enderror" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($patientInfo as $key => $value) {
                                        <option value="{{ $value->id }}" @if($value->id == old('patient_id')) selected @endif>{{ "ID: ".$value->id." Name: ".  $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_id">@lang('Select Doctor') </label>
                                <select name="doctor_id" id="doctor_id" class="form-control select2 custom-width-100 generate_report_template @error('doctor_id') is-invalid @enderror">
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($doctorInfo as $key => $value) {
                                        <option value="{{ $value->id }}" @if($value->id == old('doctor_id')) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lab_report_template_id">@lang('Select Lab Report Template') </label>
                                <select name="lab_report_template_id" id="lab_report_template_id" class="form-control custom-width-100 select2 generate_report_template @error('lab_report_template_id') is-invalid @enderror">
                                    <option value="">--@lang('Select Template')--</option>
                                    @foreach($labReportTemplates as $key => $value)
                                        <option value="{{ $value->id }}" @if($value->id == old('lab_report_template_id')) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('lab_report_template_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="report">@lang('Report')</label>
                                <div id="input_report" class="@error('address') is-invalid @enderror description-min-height"></div>
                                <input type="hidden" name="report" value="{{ old('report') }}" id="report">
                                @error('report')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="photo" class="col-md-12 col-form-label dropzone"><h4>{{ __('Photo') }}</h4></label>
                            <div class="col-md-12">
                                <div class="fallback">
                                    <input id="photo" class="dropify" name="photo[]" value="{{ old('photo') }}" type="file" data-allowed-file-extensions="pdf png jpg jpeg" data-max-file-size="1024K" multiple/>
                                </div>
                            </div>
                            @error('photo')
                                <div class="error ambitious-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('lab-reports.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/lab-report.js') }}"></script>
@endpush
