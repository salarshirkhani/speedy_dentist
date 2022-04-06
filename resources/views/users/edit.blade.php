@php
@endphp
@extends('layouts.layout')
@section('one_page_js')
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('one_page_css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('User List')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit User')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>@lang('Edit User')</h3>
            </div>
            <div class="card-body">
                <form class="form-material form-horizontal" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>@lang('Name') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name',$user->name) }}" type="text" placeholder="@lang('Type Your Name Here')" required>
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
                                <label class="col-md-12 col-form-label"><h4>{{ __('Email') }} <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" type="email" placeholder="{{ __('Type Your Email Here') }}" required>
                                    @error('email')
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
                                <label class="col-md-12 col-form-label"><h4>{{ __('Password') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading  @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="{{ __('Type Your Password Here') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small id="name" class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Confirm Password') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('password_confirmation') is-invalid @enderror" name="confirm_password" id="confirm_password" type="password" placeholder="{{ __('Type Your Confirm Password Here') }}">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small id="name" class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('User For') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('role_for') is-invalid @enderror" name="role_for" id="role_for">
                                        <option value="0" {{ old('role_for', $roleFor->role_for) == 0 ? 'selected' : '' }} >{{ __('System User') }}</option>
                                        <option value="1" {{ old('role_for', $roleFor->role_for) == 1 ? 'selected' : '' }} >{{ __('General User') }}</option>
                                    </select>
                                    @error('role_for')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Phone') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone',$user->phone) }}" type="text" placeholder="{{ __('Type Phone Number Here') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="staff_block">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>{{ __('Staff Role') }}</h4></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select class="form-control ambitious-form-loading" name="staff_roles" id="staff_roles">
                                            @foreach($staffRoles as $key => $role)
                                                <option value="{{$key}}" {{ old('staff_roles', $roleFor->name) == $key ? 'selected' : ''  }} >{{$role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>{{ __('Staff Company') }}</h4></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <select class="form-control select2bs4" id="staff_company" name="staff_company" data-placeholder="Select a company">
                                            @foreach ($companies as $value)
                                                <option value="{{ $value->id }}" {{ old('staff_company', $value->id) == $cIdStd ? 'selected' : ''  }} >{{ $value->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="user_block">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label"><h4>{{ __('User Role') }}</h4></label>
                                <div class="col-md-12">
                                    <select class="form-control ambitious-form-loading" name="user_roles" id="user_roles">
                                        @foreach($userRoles as $key => $role)
                                            <option value="{{$key}}" {{ old('user_roles', $roleFor->name) == $key ? 'selected' : '' }}>{{$role}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label"><h4>{{ __('User Company') }}</h4></label>
                                <div class="col-md-12">
                                    <select class="select2 custom-width-100" id="user_company" name="user_company[]" multiple="multiple" data-placeholder="@lang('Select a company')">
                                        @foreach ($companies as $value)
                                            <option value="{{ $value->id }}" @if(is_array(old('user_company', explode(',', $cIdStd))) && in_array($value->id, old('user_company', explode(',', $cIdStd)))) selected @endif>{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                    <input id="user_selected_companies" name="user_selected_companies" type="hidden" value="{{ $cIdStd }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Photo') }}</h4></label>
                            <div class="col-md-12">
                                <input id="photo" class="dropify" name="photo" value="{{ old('photo') }}" type="file" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2024K" />
                                <small id="name" class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                                <p>@lang('Max Size: 2MB, Allowed Format: png, jpg, jpeg')</p>
                            </div>
                            @if ($errors->has('photo'))
                                <div class="error ambitious-red">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Address') }}</h4></label>
                            <div class="col-md-12">
                                <div id="edit_input_address" class="description-min-height">
                                </div>
                                <input type="hidden" name="address" id="address" value="{{ old('address',$user->address) }}">
                            </div>
                            @if ($errors->has('address'))
                                {{ Session::flash('error',$errors->first('address')) }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>{{ __('Status') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" required="required" name="status" id="status">
                                        <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : ''  }}>{{ __('Active') }}</option>
                                        <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : ''  }}>{{ __('Inactive') }}</option>
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
                    <br><br>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('users.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/users/edit.js') }}"></script>
@endpush
