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
                        <a href="{{ route('lab-report-templates.index') }}">@lang('Lab Report Templates')</a></li>
                    <li class="breadcrumb-item active">@lang('Lab Report Template Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Lab Report Template Info')</h3>
                @can('lab-report-template-update')
                    <div class="card-tools">
                        <a href="{{ route('lab-report-templates.edit', $labReportTemplate) }}" class="btn btn-info">@lang('Edit')</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">@lang('Template Name')</label>
                            <div class="form-group input-group mb-3">
                                {{ $labReportTemplate->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 description_padding_left">
                            <label for="description" class="col-md-12 col-form-label">@lang('Template Body')</label>
                            <div class="col-md-12">
                                {!! str_replace(["script"], ["noscript"], $labReportTemplate->template) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
