@extends('layouts.layout')
@section('one_page_js')
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
@endsection

@section('one_page_css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('company.index') }}">{{ __('Company List') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Edit Company') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Edit Company') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('company.update', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-md-12">
                                <h4>{{ __('Company Name') }} <b class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-12">
                                <input class="form-control ambitious-form-loading @error('company_name') is-invalid @enderror" name="company_name" id="company_name" type="text" value="{{ old('company_name',$company->company_name) }}" placeholder="{{ __('Enter Name') }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-md-12">
                                <h4>{{ __('Company Email') }} <b class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-12">
                                <input class="form-control ambitious-form-loading @error('company_email') is-invalid @enderror" name="company_email" id="company_email" type="email" value="{{ old('company_email', $company->company_email) }}" placeholder="{{ __('Enter Company Email') }}" required>
                                @error('company_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12">
                                <h4>{{ __('Domain') }} <b class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-12">
                                <input class="form-control ambitious-form-loading @error('domain') is-invalid @enderror" name="domain" id="domain" type="text" value="{{ old('domain', $company->domain) }}" placeholder="{{ __('Enter Domain') }}" required>
                                @error('domain')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-md-12"><h4>{{ __('Photo') }} </h4></label>
                            <div class="col-md-12">
                                <input id="photo" class="dropify @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" type="file" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1024K"/>
                                <small id="name" class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}
                                </small>
                                <p>{{ __('Max Size: 1000kb, Allowed Format: png, jpg, jpeg') }}</p>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12"><h4>{{ __('Address') }}</h4></label>
                            <div class="col-md-12">
                                <div id="edit_input_address" class="form-control description-min-height @error('address') is-invalid @enderror">
                                </div>
                                <input type="hidden" name="address" id="address" value="{{ old('address',$company->company_address) }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-md-12"><h4>{{ __('Enabled') }} <b class="ambitious-crimson">*</b></h4></label>
                            <div class="col-md-12">
                                <select class="form-control ambitious-form-loading" name="enabled" id="enabled">
                                    <option value="1" {{ old('enabled', $company->enabled) == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ old('enabled', $company->enabled) == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/custom/company/edit.js') }}"></script>
@endsection
