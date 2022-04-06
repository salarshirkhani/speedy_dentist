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
                        <a href="{{ route('prescriptions.index') }}">@lang('Prescription')</a></li>
                    <li class="breadcrumb-item active">@lang('Prescription Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Prescription Info')</h3>
                <div class="card-tools">
                    @can('prescription-update')
                        <a href="{{ route('prescriptions.edit', $prescription) }}?user_id={{ $prescription->user_id }}" class="btn btn-info">@lang('Edit')</a>
                    @endcan
                    <button id="doPrint" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
            <div id="print-area" class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice p-3 mb-3">
                            <div class="text-center">
                                <p class="text-right">@lang('Prescription ID') #{{ str_pad($prescription->id, 4, '0', STR_PAD_LEFT) }}<br></p>
                                <h4>
                                    <img src="{{ $company->company_logo }}" class="custom-wi-he" alt=""> {{ $company->company_name }}
                                </h4>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-md-12 invoice-col">
                                        <address>
                                            {!! str_replace(["script"], ["noscript"], $company->company_address) !!}
                                            @lang('Email'): {{ $company->company_email }}<br>
                                            @if ($company->company_phone)
                                                @lang('Phone'): {{ $company->company_phone }}
                                            @endif
                                        </address>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id">@lang('Patient Name')</label>
                                        <p>{{ $prescription->user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="doctor_id">@lang('Doctor Name')</label>
                                        <p>{{ $prescription->doctor->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('Prescription Date')</label>
                                        <p>{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($prescription->prescription_date)) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="weight">@lang('Weight (kg)')</label>
                                        <p>{{ $prescription->weight }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">@lang('Height (feet)')</label>
                                        <p>{{ $prescription->height }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blood_pressure">@lang('Blood Pressure')</label>
                                        <p>{{ $prescription->blood_pressure }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="chief_complaint">@lang('Chief Complaint')</label>
                                        <p>{!! nl2br(str_replace(["script"], ["noscript"], $prescription->chief_complaint)) !!}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="t1" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">@lang('Medicine Name')</th>
                                                    <th scope="col">@lang('Medicine Type')</th>
                                                    <th scope="col">@lang('Instruction')</th>
                                                    <th scope="col">@lang('Days')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="medicine">
                                                @foreach(json_decode($prescription->medicine_info) as $medicineInfo)
                                                    <tr>
                                                        <td>
                                                            {{ $medicineInfo->medicine_name }}
                                                        </td>
                                                        <td>
                                                            {{ $medicineInfo->medicine_type }}
                                                        </td>
                                                        <td>
                                                            {{ $medicineInfo->instruction }}
                                                        </td>
                                                        <td>
                                                            {{ $medicineInfo->day }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">@lang('Diagnosis')</th>
                                                    <th scope="col">@lang('Instruction')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="diagnosis">
                                                @foreach (json_decode($prescription->diagnosis_info) as $diagnosisInfo)
                                                    <tr>
                                                        <td>
                                                            {{ $diagnosisInfo->diagnosis }}
                                                        </td>
                                                        <td>
                                                            {{ $diagnosisInfo->diagnosis_instruction }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">@lang('Note')</label>
                                        <p>{{ $prescription->note }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
