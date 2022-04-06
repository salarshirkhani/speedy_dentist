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
                        <a href="{{ route('lab-reports.index') }}">@lang('Lab Report')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit Lab Report')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Edit Lab Report')</h3>
            </div>
            <div class="card-body">
                <form id="labReportEditFrom" class="form-material form-horizontal" action="{{ route('lab-reports.update', $labReport) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">@lang('Date')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                    </div>
                                    <input type="text" name="date" id="date" class="form-control flatpickr" value="{{ $labReport->date }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_id">@lang('Select Patient') </label>
                                <select name="patient_id" id="patient_id" class="form-control select2 custom-width-100" disabled>
                                    @foreach($patientInfo as $key => $value) {
                                        <option value="{{ $value->id }}" @if($value->id == $labReport->patient_id)) selected @endif>{{ "ID: ".$value->id." Name: ".  $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="report">@lang('Report') <b class="ambitious-crimson">*</b></label>
                                <div id="input_report" class="@error('address') is-invalid @enderror description-min-height"></div>
                                <textarea id="report" class="custom-display-none" name="report">{{ $labReport->report }}</textarea>
                                @error('report')
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
    <script src="{{ asset('assets/js/custom/lab-report/edit.js') }}"></script>
@endpush
