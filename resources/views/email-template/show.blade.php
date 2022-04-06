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
                        <a href="{{ route('email-templates.index') }}">@lang('Email Templates')</a></li>
                    <li class="breadcrumb-item active">@lang('Email Template Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Email Template Info')</h3>
                @can('email-template-update')
                    <div class="card-tools">
                        <a href="{{ route('email-templates.edit', $emailTemplate) }}" class="btn btn-info">@lang('Edit')</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">@lang('Name')</label>
                            <div class="form-group input-group mb-3">
                                {{ $emailTemplate->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 description_padding_left">
                            <label for="description" class="col-md-12 col-form-label">@lang('Template')</label>
                            <div class="col-md-12">
                                {!! str_replace(["script"], ["noscript"], $emailTemplate->template) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
