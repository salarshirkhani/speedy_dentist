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
                            <a href="{{ route('contacts.index') }}">@lang('Contact Us')</a></li>
                        <li class="breadcrumb-item active">@lang('Contact Us Info')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Contact Us Info')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">@lang('Name')</label>
                                <div class="form-group input-group mb-3">
                                    {{ $contact->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">@lang('Email')</label>
                                <div class="form-group input-group mb-3">
                                    {{ $contact->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <label for="description" class="col-md-12 col-form-label">@lang('Message')</label>
                                <div class="col-md-12">
                                    {{ nl2br(str_replace(["script"], ["noscript"], $contact->message)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
