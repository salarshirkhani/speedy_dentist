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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Account Setting Title') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Account Setting Title') }}</h3>
                </div>
                <div class="card-body">
                    <form class="form-material form-horizontal" action="{{ route('profile.updateSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 ambitious-center">
                                <h4>{{ __('Name') }} <b class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-8">
                                <input class="form-control ambitious-form-loading" name="name" id="name" value="{{ $user->name }}" type="text" placeholder="{{ __('Type Your Name Here') }}" required>
                            </div>
                            @if ($errors->has('name'))
                                {{ Session::flash('error',$errors->first('name')) }}
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 ambitious-center">
                                <h4>{{ __('Email') }} <b class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-8">
                                <input class="form-control ambitious-form-loading" name="email" id="email" value="{{ $user->email }}" type="email" placeholder="{{ __('Type Your Email Here') }}" required>
                            </div>
                            @if ($errors->has('email'))
                                {{ Session::flash('error',$errors->first('email')) }}
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 ambitious-center"><h4>{{ __('Photo') }} </h4></label>
                            <div class="col-md-9">
                                {{ __('Max Dimension: 200 x 200, Max Size: 100kb, Allowed format: png') }}
                                <input id="photo" class="dropify" name="photo" value="{{ old('photo') }}" type="file" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="100K"/><small id="name" class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                            </div>
                            @if ($errors->has('photo'))
                                <div class="error ambitious-red">{{ $errors->first('photo') }}</div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 ambitious-center"><h4>{{ __('Phone') }}</h4></label>
                            <div class="col-md-8">
                                <input class="form-control ambitious-form-loading" name="phone" value="{{ $user->phone }}" id="phone" type="text" placeholder="{{ __('Type Your Phone Here') }}">
                            </div>
                            @if ($errors->has('phone'))
                                {{ Session::flash('error',$errors->first('phone')) }}
                            @endif
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 ambitious-center"><h4>{{ __('Address') }}</h4></label>
                            <div class="col-md-8">
                                <div id="edit_input_address">
                                </div>
                                <input type="hidden" name="address" id="address" value="{{ $user->address }}">
                            </div>
                            @if ($errors->has('address'))
                                {{ Session::flash('error',$errors->first('address')) }}
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="card-footer">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/custom/setting.js') }}"></script>
@endsection
