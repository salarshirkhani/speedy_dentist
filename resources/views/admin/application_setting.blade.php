@extends('layouts.layout')
@section('one_page_js')
    <script src="{{ asset('assets/js/quill.js') }}"></script>
@endsection
@section('one_page_css')
     <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Application Configuration') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Application Configuration') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('apsetting.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Item Name') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-chess-king"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('item_name') is-invalid @enderror" name="item_name" id="item_name" type="text" placeholder="{{ __('Type Your Item Name Here') }}" value="{{ old('item_name',$data->item_name) }}" >
                                    @error('item_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Item Short Name') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-chess-pawn"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('item_short_name') is-invalid @enderror" name="item_short_name" id="item_short_name" type="text" placeholder="{{ __('Type Your Item Short Name Here') }}" value="{{ old('item_short_name',$data->item_short_name) }}" required>
                                    @error('item_short_name')
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
                                <label class="col-md-12 col-form-label"><h4>{{ __('Company Name') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('company_name') is-invalid @enderror" name="company_name" id="company_name" type="text" placeholder="{{ __('Type Your Company Name Here') }}" value="{{ old('company_name',$data->company_name) }}" required>
                                    @error('company_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Company Email') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('company_email') is-invalid @enderror" name="company_email" id="company_email" type="text" placeholder="{{ __('Type Your Comapny Email Here') }}" value="{{ old('company_email',$data->company_email) }}" required>
                                    @error('company_email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Company Address') }} <b class="ambitious-crimson">*</b></h4></label>
                            <div class="col-md-12">
                                <div id="company_address" class="description-min-height"></div>
                                <input type="hidden" name="address" id="address" value="{{ old('address',$data->company_address) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Deafult Language') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-language"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('language') is-invalid @enderror" name="language" id="language">
                                        @php
                                            $defaultLang = env('LOCALE_LANG', 'en');
                                        @endphp
                                        @foreach($getLang as $key => $value)
                                            <option value="{{ $key }}" {{ old('language', $defaultLang) == $key ? 'selected' : '' }} >{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Time Zone') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hourglass-start"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('time_zone') is-invalid @enderror" name="time_zone" id="time_zone">
                                        @foreach($timezone as $key => $value)
                                            <option value="{{ $key }}" {{ old('time_zone', $data->time_zone) == $key ? 'selected' : '' }} >{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('time_zone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Logo') }}</h4></label>
                            <div class="col-md-12">

                                <input id="logo" class="dropify" name="logo" value="{{ old('logo') }}" type="file" data-allowed-file-extensions="png" data-max-file-size="2024K" />
                                <p>{{ __('Max Size: 2MB, Allowed Format: png') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Favicon') }}</h4></label>
                            <div class="col-md-12">

                                <input id="favicon" class="dropify" name="favicon" value="{{ old('favicon') }}" type="file" data-allowed-file-extensions="png" data-max-file-size="500K" />
                                <p>{{ __('Max Size: 2MB, Allowed Format: png') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/custom/application.js') }}"></script>
@endsection
