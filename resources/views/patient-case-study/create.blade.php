@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('patient-case-studies.index') }}">@lang('Patient Case Study')</a></li>
                    <li class="breadcrumb-item active">@lang('Add Patient Case Study')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Patient Case Study')</h3>
            </div>
            <div class="card-body">
                <form id="patientForm" class="form-material form-horizontal" action="{{ route('patient-case-studies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_id">@lang('Select Patient') <b class="ambitious-crimson">*</b></label>
                                <select name="user_id" id="user_id" class="form-control custom-width-100 select2 @error('user_id') is-invalid @enderror" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($patientInfo as $key => $value)
                                        <option value="{{ $key }}" @if($key == old('user_id')) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="food_allergy">@lang('Food Allergy')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pizza-slice"></i></span>
                                    </div>
                                    <input type="text" id="food_allergy" name="food_allergy" value="{{ old('food_allergy') }}" class="form-control @error('food_allergy') is-invalid @enderror" placeholder="@lang('Food Allergy')">
                                    @error('food_allergy')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heart_disease">@lang('Heart Disease')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heart-broken"></i></span>
                                    </div>
                                    <input type="text" id="heart_disease" name="heart_disease" value="{{ old('heart_disease') }}" class="form-control @error('heart_disease') is-invalid @enderror" placeholder="@lang('Heart Disease')">
                                    @error('heart_disease')
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
                                <label for="high_blood_pressure">@lang('High Blood Pressure')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                    </div>
                                    <input type="text" id="high_blood_pressure" name="high_blood_pressure" value="{{ old('high_blood_pressure') }}" class="form-control @error('high_blood_pressure') is-invalid @enderror" placeholder="@lang('High Blood Pressure')">
                                    @error('high_blood_pressure')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diabetic">@lang('Diabetic')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-drumstick-bite"></i></span>
                                    </div>
                                    <input type="text" id="diabetic" name="diabetic" value="{{ old('diabetic') }}" class="form-control @error('diabetic') is-invalid @enderror" placeholder="@lang('Diabetic')">
                                    @error('diabetic')
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
                                <label for="surgery">@lang('Surgery')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                                    </div>
                                    <input type="text" id="surgery" name="surgery" value="{{ old('surgery') }}" class="form-control @error('surgery') is-invalid @enderror" placeholder="@lang('Surgery')">
                                    @error('surgery')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="accident">@lang('Accident')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-car-crash"></i></span>
                                    </div>
                                    <input type="text" id="accident" name="accident" value="{{ old('accident') }}" class="form-control @error('accident') is-invalid @enderror" placeholder="@lang('Accident')">
                                    @error('accident')
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
                                <label for="others">@lang('Others')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-ethereum"></i></span>
                                    </div>
                                    <input type="text" id="others" name="others" value="{{ old('others') }}" class="form-control @error('others') is-invalid @enderror" placeholder="@lang('Others')">
                                    @error('others')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="family_medical_history">@lang('Family Medical History')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-history"></i></span>
                                    </div>
                                    <input type="text" id="family_medical_history" name="family_medical_history" value="{{ old('family_medical_history') }}" class="form-control @error('family_medical_history') is-invalid @enderror" placeholder="@lang('Family Medical History')">
                                    @error('family_medical_history')
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
                                <label for="current_medication">@lang('Current Medication')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-capsules"></i></span>
                                    </div>
                                    <input type="text" id="current_medication" name="current_medication" value="{{ old('current_medication') }}" class="form-control @error('current_medication') is-invalid @enderror" placeholder="@lang('Current Medication')">
                                    @error('current_medication')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pregnancy">@lang('Pregnancy')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-child"></i></span>
                                    </div>
                                    <input type="text" id="pregnancy" name="pregnancy" value="{{ old('pregnancy') }}" class="form-control @error('pregnancy') is-invalid @enderror" placeholder="@lang('Pregnancy')">
                                    @error('pregnancy')
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
                                <label for="breastfeeding">@lang('Breast Feeding')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-baby"></i></span>
                                    </div>
                                    <input type="text" id="breastfeeding" name="breastfeeding" value="{{ old('breastfeeding') }}" class="form-control @error('breastfeeding') is-invalid @enderror" placeholder="@lang('Breast Feeding')">
                                    @error('breastfeeding')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="health_insurance">@lang('Health Insurance')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-briefcase-medical"></i></span>
                                    </div>
                                    <input type="text" name="health_insurance" id="health_insurance" class="form-control @error('health_insurance') is-invalid @enderror" placeholder="@lang('Health Insurance')" value="{{ old('health_insurance') }}">
                                    @error('health_insurance')
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
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('patient-case-studies.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
