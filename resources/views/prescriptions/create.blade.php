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
                    <li class="breadcrumb-item active">@lang('Add Prescription')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Prescription')</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">@lang('Select Patient') <b class="ambitious-crimson">*</b></label>
                                <select name="user_id" id="user_id" class="form-control custom-width-100 select2 @error('user_id') is-invalid @enderror" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach($patients as $patient) {
                                        <option value="{{ $patient->id }}" @if($patient->id == request()->user_id) selected @endif>{{ $patient->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Prescription Date') <b class="ambitious-crimson">*</b></label>
                                <input type="text" name="prescription_date" id="prescription_date" class="form-control flatpickr @error('prescription_date') is-invalid @enderror" placeholder="@lang('Prescription Date')" value="{{ old('prescription_date', date('Y-m-d')) }}" required>
                                @error('prescription_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" data-toggle="collapse" href="#caseStudy"><i class="fas fa-file-alt"></i> @lang('Case Study')</button>
                        </div>
                        <br><br>
                    </div>
                    <div id="caseStudy" class="collapse">
                        <div class="card-body border">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="food_allergy">@lang('Food Allergy')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pizza-slice"></i></span>
                                            </div>
                                            <input type="text" id="food_allergy" name="food_allergy" value="{{ old('food_allergy', $patientCaseStudy->food_allergy ?? null) }}" class="form-control @error('food_allergy') is-invalid @enderror" placeholder="@lang('Food Allergy')">
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
                                            <input type="text" id="heart_disease" name="heart_disease" value="{{ old('heart_disease', $patientCaseStudy->heart_disease ?? null) }}" class="form-control @error('heart_disease') is-invalid @enderror" placeholder="@lang('Heart Disease')">
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
                                            <input type="text" id="high_blood_pressure" name="high_blood_pressure" value="{{ old('high_blood_pressure', $patientCaseStudy->high_blood_pressure ?? null) }}" class="form-control @error('high_blood_pressure') is-invalid @enderror" placeholder="@lang('High Blood Pressure')">
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
                                            <input type="text" id="diabetic" name="diabetic" value="{{ old('diabetic', $patientCaseStudy->diabetic ?? null) }}" class="form-control @error('diabetic') is-invalid @enderror" placeholder="@lang('Diabetic')">
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
                                                <span class="input-group-text"><i class="fas fa-user-nurse"></i></span>
                                            </div>
                                            <input type="text" id="surgery" name="surgery" value="{{ old('surgery', $patientCaseStudy->surgery ?? null) }}" class="form-control @error('surgery') is-invalid @enderror" placeholder="@lang('Surgery')">
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
                                            <input type="text" id="accident" name="accident" value="{{ old('accident', $patientCaseStudy->accident ?? null) }}" class="form-control @error('accident') is-invalid @enderror" placeholder="@lang('Accident')">
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
                                            <input type="text" id="others" name="others" value="{{ old('others', $patientCaseStudy->others ?? null) }}" class="form-control @error('others') is-invalid @enderror" placeholder="@lang('Others')">
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
                                            <input type="text" id="family_medical_history" name="family_medical_history" value="{{ old('family_medical_history', $patientCaseStudy->family_medical_history ?? null) }}" class="form-control @error('family_medical_history') is-invalid @enderror" placeholder="@lang('Family Medical History')">
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
                                            <input type="text" id="current_medication" name="current_medication" value="{{ old('current_medication', $patientCaseStudy->current_medication ?? null) }}" class="form-control @error('current_medication') is-invalid @enderror" placeholder="@lang('Current Medication')">
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
                                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                                            </div>
                                            <input type="text" id="pregnancy" name="pregnancy" value="{{ old('pregnancy', $patientCaseStudy->pregnancy ?? null) }}" class="form-control @error('pregnancy') is-invalid @enderror" placeholder="@lang('Pregnancy')">
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
                                            <input type="text" id="breastfeeding" name="breastfeeding" value="{{ old('breastfeeding', $patientCaseStudy->breastfeeding ?? null) }}" class="form-control @error('breastfeeding') is-invalid @enderror" placeholder="@lang('Breast feeding')">
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
                                            <input type="text" name="health_insurance" id="health_insurance" class="form-control @error('health_insurance') is-invalid @enderror" placeholder="@lang('Health Insurance')" value="{{ old('health_insurance', $patientCaseStudy->health_insurance ?? null) }}">
                                            @error('health_insurance')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight">@lang('Weight (kg)') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                    </div>
                                    <input type="text" id="weight" name="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror" placeholder="@lang('Weight (kg)')" required>
                                    @error('weight')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="height">@lang('Height (feet)') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                    </div>
                                    <input type="text" id="height" name="height" value="{{ old('height') }}" class="form-control @error('height') is-invalid @enderror" placeholder="@lang('Height')" required>
                                    @error('height')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_pressure">@lang('Blood Pressure') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                    </div>
                                    <input type="text" id="blood_pressure" name="blood_pressure" value="{{ old('blood_pressure') }}" class="form-control @error('blood_pressure') is-invalid @enderror" placeholder="@lang('Blood Pressure')" required>
                                    @error('blood_pressure')
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
                                <label for="chief_complaint">@lang('Chief Complaint') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <textarea name="chief_complaint" id="chief_complaint" class="form-control @error('chief_complaint') is-invalid @enderror" rows="4" placeholder="@lang('Chief Complaint')" required>{{ old('chief_complaint') }}</textarea>
                                    @error('chief_complaint')
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
                            <div class="table-responsive">
                                <table id="t1" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('Medicine Name')</th>
                                            <th scope="col">@lang('Medicine Type')</th>
                                            <th scope="col">@lang('Instruction')</th>
                                            <th scope="col">@lang('Days')</th>
                                            <th scope="col" class="custom-white-space">@lang('Add / Remove')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (old('medicine_name'))
                                            @foreach (old('medicine_name') as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="medicine_name[]" class="form-control" value="{{ old('medicine_name')[$key] }}" placeholder="@lang('Medicine Name')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medicine_type[]" class="form-control" value="{{ old('medicine_type')[$key] }}" placeholder="@lang('Medicine Type')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="instruction[]" class="form-control" value="{{ old('instruction')[$key] }}" placeholder="@lang('Instructions')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="day[]" class="form-control" value="{{ old('day')[$key] }}" placeholder="@lang('Days')">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tbody id="medicine">
                                        <tr>
                                            <td>
                                                <input type="text" name="medicine_name[]" class="form-control" value="" placeholder="@lang('Medicine Name')">
                                            </td>
                                            <td>
                                                <input type="text" name="medicine_type[]" class="form-control" value="" placeholder="@lang('Medicine Type')">
                                            </td>
                                            <td>
                                                <input type="text" name="instruction[]" class="form-control" value="" placeholder="@lang('Instructions')">
                                            </td>
                                            <td>
                                                <input type="text" name="day[]" class="form-control" value="" placeholder="@lang('Days')">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
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
                                            <th scope="col" class="custom-white-space custom-width-120">@lang('Add / Remove')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (old('diagnosis'))
                                            @foreach (old('diagnosis') as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="diagnosis[]" class="form-control" value="{{ old('diagnosis')[$key] }}" placeholder="@lang('Diagnosis')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="diagnosis_instruction[]" class="form-control" value="{{ old('diagnosis_instruction')[$key] }}" placeholder="@lang('Instruction')">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info d-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-info d-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tbody id="diagnosis">
                                        <tr>
                                            <td>
                                                <input type="text" name="diagnosis[]" class="form-control" value="" placeholder="@lang('Diagnosis')">
                                            </td>
                                            <td>
                                                <input type="text" name="diagnosis_instruction[]" class="form-control" value="" placeholder="@lang('Instruction')">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info d-add"><i class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-info d-remove"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">@lang('Note')</label>
                                <div class="input-group mb-3">
                                    <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="4" placeholder="@lang('Note')">{{ old('note') }}</textarea>
                                    @error('note')
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
                                    <a href="{{ route('prescriptions.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('assets/js/custom/prescription.js') }}"></script>
@endpush
