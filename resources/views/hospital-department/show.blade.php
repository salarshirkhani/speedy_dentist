@extends('layouts.layout')
@section('one_page_css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
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
                            <a href="{{ route('hospital-departments.index') }}">@lang('Hospital Departments')</a></li>
                        <li class="breadcrumb-item active">@lang('Department Info')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Department Info')</h3>
                    @can('hospital-department-update')
                        <div class="card-tools">
                            <a href="{{ route('hospital-departments.edit', $hospitalDepartment) }}" class="btn btn-info">@lang('Edit')</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">@lang('Department Name')</label>
                                <div class="form-group input-group mb-3">
                                    {{ $hospitalDepartment->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <label for="description" class="col-md-12 col-form-label">@lang('Description')</label>
                                <div class="col-md-12">
                                    {!! $hospitalDepartment->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">@lang('Status')</label>
                                <div class="form-group input-group mb-3">
                                    @if ($hospitalDepartment->status)
                                        <span class="badge badge-pill badge-success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">@lang('Inactive')</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
