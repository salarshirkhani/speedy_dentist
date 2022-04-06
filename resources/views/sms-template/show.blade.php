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
                        <a href="{{ route('sms-templates.index') }}">@lang('SMS Templates')</a></li>
                    <li class="breadcrumb-item active">@lang('SMS Template Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('SMS Template Info')</h3>
                <div class="card-tools">
                    <a href="{{ route('sms-templates.edit', $smsTemplate) }}" class="btn btn-info">@lang('Edit')</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">@lang('Name')</label>
                            <div class="form-group input-group mb-3">
                                {{ $smsTemplate->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 description_padding_left">
                            <label for="description" class="col-md-12 col-form-label">@lang('Template')</label>
                            <div class="col-md-12">
                                {!! str_replace(["script"], ["noscript"], $smsTemplate->template) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
