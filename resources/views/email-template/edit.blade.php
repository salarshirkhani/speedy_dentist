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
                        <a href="{{ route('email-templates.index') }}">@lang('Email Template')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit Email Template')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Edit Email Template')</h3>
            </div>
            <div class="card-body">
                <form id="patientForm" class="form-material form-horizontal" action="{{ route('email-templates.update', $emailTemplate) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">@lang('Name') <b class="ambitious-crimson">*</b></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name', $emailTemplate->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Name')" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="template">@lang('Template Body') <b class="ambitious-crimson">*</b></label>
                            <br>
                            <span class="hide_in_read">
                                <a id="textarea_name" class="btn btn-default btn-sm">#NAME#</a>
                                <a id="textarea_phone" class="btn btn-default btn-sm">#PHONE#</a>
                                <a id="textarea_email_address" class="btn btn-default btn-sm">#Email_ADDRESS#</a>
                            </span>
                            <div class="input-group mb-3">
                                <textarea name="template" id="template" class="form-control @error('template') is-invalid @enderror" rows="4" placeholder="@lang('Template Body')" required>{{ old('template', $emailTemplate->template) }}</textarea>
                                @error('template')
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
                                    <a href="{{ route('email-templates.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/custom/email-template.js') }}"></script>
@endsection
