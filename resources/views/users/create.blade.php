@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('User List')</a></li>
                    <li class="breadcrumb-item active">@lang('Create User')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>@lang('Create User')</h3>
            </div>
            <div class="card-body">
                <form id="userQuickForm" class="form-material form-horizontal" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>@lang('Name') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" type="text" placeholder="@lang('Type Your Name Here')" required>
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
                                <label class="col-md-12 col-form-label"><h4>@lang('Email') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="@lang('Type Your Email Here')" required>
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
                                <label class="col-md-12 col-form-label"><h4>@lang('Password') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="@lang('Type Your Password Here')" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-form-label"><h4>@lang('Confirm Password') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" type="password" placeholder="@lang('Type Your Confirm Password Here')" required>
                                    @error('password_confirmation')
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
                                <label class="col-md-12 col-form-label"><h4>@lang('User For')</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('role_for') is-invalid @enderror" name="role_for" id="role_for">
                                        <option value="0" {{ old('role_for') == 0 ? 'selected' : '' }}>@lang('System User')</option>
                                        <option value="1" {{ old('role_for') == 1 ? 'selected' : '' }}>@lang('General User')</option>
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
                                <label class="col-md-12 col-form-label"><h4>@lang('Phone')</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input class="form-control ambitious-form-loading @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" id="phone" type="text" placeholder="@lang('Type Phone Number Here')">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>@lang('Staff Role')</h4></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select class="form-control ambitious-form-loading @error('staff_roles') is-invalid @enderror" name="staff_roles" id="staff_roles">
                                            @foreach($staffRoles as $key => $role)
                                                <option value="{{$key}}" {{ old('staff_roles') == $key ? 'selected' : '' }}>{{$role}}</option>
                                            @endforeach
                                        </select>
                                        @error('staff_roles')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>@lang('Staff Company')</h4></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <select class="form-control select2bs4 @error('staff_company') is-invalid @enderror" id="staff_company" name="staff_company" data-placeholder="@lang('Select a company')">
                                            @foreach ($companies as $value)
                                                <option value="{{ $value->id }}" {{ old('staff_company') == $value->id ? 'selected' : '' }} >{{ $value->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('staff_company')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="user_block">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>@lang('User Role')</h4></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select class="form-control ambitious-form-loading @error('user_roles') is-invalid @enderror" name="user_roles" id="user_roles">
                                            @foreach($userRoles as $key => $role)
                                                <option value="{{$key}}" {{ old('user_roles') == $key ? 'selected' : '' }}>{{$role}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_roles')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label"><h4>@lang('User Company')</h4></label>
                                    <div class="input-group mb-3">
                                        <select class="select2 select2-primary custom-width-100 @error('user_company') is-invalid @enderror" id="user_company" name="user_company[]" multiple="multiple" data-placeholder="Select a company">
                                            @foreach ($companies as $value)
                                                <option value="{{ $value->id }}" @if(is_array(old('user_company')) && in_array($value->id, old('user_company'))) selected @endif>{{ $value->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_company')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Photo') }}</h4></label>
                            <div class="col-md-12">

                                <input id="photo" class="dropify" name="photo" value="{{ old('photo') }}" type="file" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2024K" />
                                <p>{{ __('Max Size: 2MB, Allowed Format: png, jpg, jpeg') }}</p>
                            </div>
                            @if ($errors->has('photo'))
                                <div class="error ambitious-red">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label"><h4>{{ __('Address') }}</h4></label>
                            <div class="col-md-12">
                                <div id="input_address" class="@error('address') is-invalid @enderror description-min-height">
                                </div>
                                <input type="hidden" name="address" value="{{ old('address') }}" id="address">
                                @error('address')
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
                                <label class="col-md-12 col-form-label"><h4>{{ __('Status') }}</h4></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                    </div>
                                    <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" required="required" name="status" id="status">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
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
                        <label class="col-md-3 col-form-label"></label>
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
    <script src="{{ asset('assets/js/custom/users/create.js') }}"></script>
@endpush
