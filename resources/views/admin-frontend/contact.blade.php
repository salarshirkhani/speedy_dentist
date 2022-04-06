@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front-ends.index') }}">@lang('Front-ends')</a></li>
                        <li class="breadcrumb-item active">@lang(ucfirst($frontEnd->page))</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Edit '.ucfirst($frontEnd->page))</h3>
                </div>
                <div class="card-body">
                    <form id="departmentForm" class="form-material form-horizontal" action="{{ route('front-ends.updateContact', $frontEnd) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fas fa-file-contract"></i> @lang('Contact Settings')</legend>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Address') *</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('contactAddress') is-invalid @enderror" name="contactAddress" required>{{ old('contactAddress', $contents->contactAddress) }}</textarea>
                                            @error('contactAddress')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Phone') *</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('contactPhone') is-invalid @enderror" name="contactPhone" required>{{ old('contactPhone', $contents->contactPhone) }}</textarea>
                                            @error('contactPhone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Mail') *</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('contactMail') is-invalid @enderror" name="contactMail" required>{{ old('contactMail', $contents->contactMail) }}</textarea>
                                            @error('contactMail')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fas fa-map-marker-alt"></i> @lang('Map')</legend>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Embed Code') *</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('contactGoogleMap') is-invalid @enderror" name="contactGoogleMap" rows="4" required>{{ old('contactGoogleMap', $contents->contactGoogleMap) }}</textarea>
                                            @error('contactGoogleMap')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" value="@lang('Submit')" class="btn btn-outline btn-info btn-lg"/>
                                        <a href="{{ route('front-ends.index') }}" class="btn btn-outline btn-warning btn-lg">@lang('Cancel')</a>
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
