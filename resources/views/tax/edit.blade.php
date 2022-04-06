@extends('layouts.layout')
@section('one_page_js')
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

@endsection

@section('one_page_css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
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
                        <a href="{{ route('tax.index') }}">{{ __('Tax Rates') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Edit Tax Rate') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit Tax Rate') }}</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('tax.update', $data) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ encrypt($data->id) }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Name') }} <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-check-alt"></i>
                                    </div>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter Name') }}" value="{{ old('name', $data->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Rate (%)') }} <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input name="rate" type="number" id="rate" class="form-control @error('rate') is-invalid @enderror" placeholder="{{ __('Enter Rate') }}" value="{{ old('rate', $data->rate) }}" step="0.01" required>
                                    @error('rate')
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
                                <label>{{ __('Type') }} <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <select class="form-control @error('type') is-invalid @enderror" required="required" id="type" name="type">
                                        <option value="">- {{ __('Select Type') }} -</option>
                                        <option value="inclusive" @if(old('type', $data->type) == 'inclusive') selected="selected" @endif>{{ __('Inclusive') }}</option>
                                        <option value="exclusive" @if(old('type', $data->type) == 'exclusive') selected="selected" @endif>{{ __('Exclusive') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="enabled">{{ __('Status') }} <b class="ambitious-crimson">*</b></label>
                            <div class="form-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                </div>
                                <select class="form-control ambitious-form-loading @error('enabled') is-invalid @enderror" required="required" name="enabled" id="enabled">
                                    <option value="1" {{ old('enabled', $data->enabled) == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ old('enabled', $data->enabled) == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                                </select>
                                @error('enabled')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('tax.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
