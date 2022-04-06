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
                        <a href="{{ route('smtp-configurations.index') }}">@lang('SMTP List')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit SMTP')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Edit SMTP')</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('smtp-configurations.update', $data) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12"><h4>@lang('Sender Name') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading  @error('sender_name') is-invalid @enderror" name="sender_name" value="{{ old('sender_name', $data->sender_name) }}" id="sender_name" type="text" placeholder="@lang('Please Type Your Name')" required>
                                    @error('sender_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12"><h4>@lang('Sender Email') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('sender_email') is-invalid @enderror" name="sender_email" id="sender_email" type="text" placeholder="@lang('Please Type Your Smtp Email')" value="{{ old('sender_email',$data->sender_email) }}" required>
                                    @error('sender_email')
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
                                <label class="col-md-12"><h4>@lang('Host') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-share"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('smtp_host') is-invalid @enderror" name="smtp_host" id="smtp_host" type="text" placeholder="@lang('Please Type Your Smtp Host')" value="{{ old('smtp_host',$data->smtp_host) }}" required>
                                    @error('smtp_host')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12">
                                    <h4>@lang('Port') <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('smtp_port') is-invalid @enderror" name="smtp_port" id="smtp_port" type="text" placeholder="@lang('Please Type Your Smtp Port')" value="{{ old('smtp_port',$data->smtp_port) }}" required>
                                    @error('smtp_port')
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
                                <label class="col-md-12">
                                    <h4>@lang('User') <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('smtp_user') is-invalid @enderror" name="smtp_user" id="smtp_user" type="text" placeholder="@lang('Please Type Your Smtp User')" value="{{ old('smtp_user',$data->smtp_user) }}" required>
                                    @error('smtp_user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12">
                                    <h4>@lang('Password') <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('smtp_password') is-invalid @enderror" name="smtp_password" id="smtp_password" type="text" placeholder="@lang('Please Type Your Smtp Password')" value="{{ old('smtp_password',$data->smtp_password) }}" required>
                                    @error('smtp_password')
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
                                <label class="col-md-12">
                                    <h4>@lang('Type') <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-typo3"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('smtp_type') is-invalid @enderror" name="smtp_type" id="smtp_type">
                                        <option value="default" {{ old('smtp_type', $data->smtp_type) == "default" ? 'selected' : '' }} >{{ __('Default') }}</option>
                                        <option value="ssl" {{ old('smtp_type', $data->smtp_type) == "ssl" ? 'selected' : '' }} >{{ __('Ssl') }}</option>
                                        <option value="tls" {{ old('smtp_type', $data->smtp_type) == "tls" ? 'selected' : '' }} >{{ __('Tls') }}</option>
                                    </select>
                                    @error('smtp_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12">
                                    <h4>@lang('Status') <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : ''  }} >{{ __('Active') }}</option>
                                        <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : ''  }} >{{ __('Inactive') }}</option>
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
                    <div class="form-group">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" value="@lang('Submit')" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('smtp-configurations.index') }}" class="btn btn-outline btn-warning btn-lg">@lang('Cancel')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
