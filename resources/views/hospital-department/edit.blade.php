@extends('layouts.layout')
@section('one_page_css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('hospital-departments.index') }}">@lang('Hospital Departments')</a></li>
                        <li class="breadcrumb-item active">@lang('Edit Department')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Edit Department')</h3>
                </div>
                <div class="card-body">
                    <form id="departmentForm" class="form-material form-horizontal" action="{{ route('hospital-departments.update', $hospitalDepartment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">@lang('Department Name') <b class="ambitious-crimson">*</b></label>
                                    <div class="form-group input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                        </div>
                                        <input type="text" id="name" name="name" value="{{ old('name', $hospitalDepartment->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Department Name')" required>
                                        @error('name')
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
                                    <label for="description" class="col-md-12 col-form-label">@lang('Description')</label>
                                    <div class="col-md-12">
                                        <div id="description" class="form-control description-min-height @error('description') is-invalid @enderror"></div>
                                        <textarea id="dText" class="custom-display-none" name="description">{{ old('description', $hospitalDepartment->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">@lang('Status') <b class="ambitious-crimson">*</b></label>
                                    <div class="form-group input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                        </div>
                                        <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" required="required" name="status" id="status">
                                            <option value="1" {{ old('status', $hospitalDepartment->status) === '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                            <option value="0" {{ old('status', $hospitalDepartment->status) === '0' ? 'selected' : '' }}>{{ __('No') }}</option>
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
                                        <input type="submit" value="@lang('Submit')" class="btn btn-outline btn-info btn-lg"/>
                                        <a href="{{ route('hospital-departments.index') }}" class="btn btn-outline btn-warning btn-lg">@lang('Cancel')</a>
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
@push('footer')
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script src="{{ asset('assets/js/custom/hospital-department/create.js') }}"></script>
@endpush
