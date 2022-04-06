@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('patient-case-studies.index') }}">@lang('Patient')</a></li>
                    <li class="breadcrumb-item active">@lang('Patient Case Study')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ $patientCaseStudy->user->photo_url }}" alt="" />
                </div>
                <h3 class="profile-username text-center">{{ $patientCaseStudy->user->name }}</h3>
                <p class="text-muted text-center">{{ $patientCaseStudy->user->email }}</p>
                <p class="text-center">{{ $patientCaseStudy->user->phone }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Patient Case Study Info')</h3>
                @can('patient-case-studies-update')
                    <div class="card-tools">
                        <a href="{{ route('patient-case-studies.edit', $patientCaseStudy) }}" class="btn btn-info">@lang('Edit')</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Food Allergy')</label>
                            <p>{{ $patientCaseStudy->food_allergy }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Heart Disease')</label>
                            <p>{{ $patientCaseStudy->heart_disease }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('High Blood Pressure')</label>
                            <p>{{ $patientCaseStudy->high_blood_pressure }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Diabetic')</label>
                            <p>{{ $patientCaseStudy->diabetic }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Surgery')</label>
                            <p>{{ $patientCaseStudy->surgery }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('Accident')</label>
                            <p>{{ $patientCaseStudy->accident }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Others')</label>
                            <p>{{ $patientCaseStudy->others }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Family Medical History')</label>
                            <p>{{ $patientCaseStudy->family_medical_history }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('Current Medication')</label>
                            <p>{{ $patientCaseStudy->current_medication }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Pregnancy')</label>
                            <p>{{ $patientCaseStudy->pregnancy }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Breast Feeding')</label>
                            <p>{{ $patientCaseStudy->breastfeeding }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('Health Insurance')</label>
                            <p>{{ $patientCaseStudy->health_insurance }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
