@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3>@lang('SMS Api')</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active">@lang('SMS Api')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="card">
    <nav>
        @php
            $i = 1;
        @endphp
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach ($smsApis as $smsApi)
            <a class="nav-item nav-link @if($i == 1) active @endif @if($smsApi->status == 1) sms-active-back @endif" id="nav-{{$smsApi->gateway}}-tab" data-toggle="tab" href="#nav-{{$smsApi->gateway}}" role="tab" aria-controls="nav-{{$smsApi->gateway}}" aria-selected="false">{{ucfirst($smsApi->gateway)}}</a>
            @php
                $i++;
            @endphp
        @endforeach
        </div>
    </nav>
    <div class="card-body custom-padding-top-0">
        <section id="tabs" class="project-tab">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content" id="nav-tabContent">
                        @foreach ($smsApis as $smsApi)
                            <div class="tab-pane fade @if($smsApi->gateway == "twilio")show active @endif" id="nav-{{ $smsApi->gateway }}" role="tabpanel" aria-labelledby="nav-{{ $smsApi->gateway }}-tab">
                                <form class="form-material form-horizontal" action="{{ route('sms-apis.update', $smsApi) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="gateway" value="{{ $smsApi->gateway }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="auth_id">@lang('Auth ID/ Auth Key/ API Key/ Account SID/ Account ID') </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-autoprefixer"></i></span>
                                                    </div>
                                                    <input type="text" id="auth_id" name="auth_id" value="{{ old('auth_id', $smsApi->auth_id) }}" class="form-control @error('auth_id') is-invalid @enderror" placeholder="@lang('auth id/ auth key/ api key/ account sid/ account id')" >
                                                    @error('auth_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="auth_token">@lang('Auth Token/ API Secret/ Password') </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input type="text" id="auth_token" name="auth_token" value="{{ old('auth_token', $smsApi->auth_token) }}" class="form-control @error('auth_token') is-invalid @enderror" placeholder="@lang('auth token/ api Secret/ password')">
                                                    @error('auth_token')
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
                                                <label for="api_id">@lang('API ID') </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-quinscape"></i></span>
                                                    </div>
                                                    <input type="text" id="api_id" name="api_id" value="{{ old('api_id', $smsApi->api_id) }}" class="form-control @error('api_id') is-invalid @enderror" placeholder="@lang('api id')">
                                                    @error('api_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sender_number">@lang('Sender/ Mask/ From') </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-terminal"></i></span>
                                                    </div>
                                                    <input type="text" id="sender_number" name="sender_number" value="{{ old('sender_number', $smsApi->sender_number) }}" class="form-control @error('sender_number') is-invalid @enderror" placeholder="@lang('sender number')">
                                                    @error('sender_number')
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
                                                <label for="status">@lang('Status') </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                                    </div>
                                                    <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" name="status" id="status">
                                                        <option value="1" {{ old('status', $smsApi->status) == "1" ? 'selected' : '' }}>@lang('Active')</option>
                                                        <option value="0" {{ old('status', $smsApi->status) == "0" ? 'selected' : '' }}>@lang('Inactive')</option>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-8">
                                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                                    <a href="{{ route('sms-apis.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
