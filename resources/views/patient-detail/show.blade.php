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
                        <a href="{{ route('patient-details.index') }}">@lang('Patient')</a></li>
                    <li class="breadcrumb-item active">@lang('Patient Info')</li>
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
                    <img class="profile-user-img img-fluid img-circle" src="{{ $patientDetail->photo_url }}" alt="" />
                </div>
                <h3 class="profile-username text-center">{{ $patientDetail->name }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Patient Info')</h3>
                @can('patient-detail-update')
                    <div class="card-tools">
                        <a href="{{ route('patient-details.edit', $patientDetail) }}" class="btn btn-info">@lang('Edit')</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Name')</label>
                            <p>{{ $patientDetail->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Email')</label>
                            <p>{{ $patientDetail->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('Phone')</label>
                            <p>{{ $patientDetail->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">@lang('Gender')</label>
                            <p>{{ ucfirst($patientDetail->gender) }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="blood_group">@lang('Blood Group')</label>
                            <p>{{ $patientDetail->blood_group }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_birth">@lang('Date of Birth')</label>
                            <p>{{ $patientDetail->date_of_birth }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">@lang('Address')</label>
                            <p>{!! $patientDetail->address !!}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('Status')</label>
                            <p>
                                @if($patientDetail->status == 1)
                                    <span class="badge badge-pill badge-success">@lang('Active')</span>
                                @else
                                    <span class="badge badge-pill badge-danger">@lang('Inactive')</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
