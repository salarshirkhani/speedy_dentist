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
                        <a href="{{ route('account-headers.index') }}">@lang('Account Header')</a></li>
                    <li class="breadcrumb-item active">@lang('Account Header Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Account Header Info')</h3>
                <div class="card-tools">
                    @can('account-header-update')
                        <a href="{{ route('account-headers.edit', $accountHeader) }}" class="btn btn-info">@lang('Edit')</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">@lang('Account Name')</label>
                            <p>{{ $accountHeader->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="type">@lang('Account Type')</label>
                            <p>{{ $accountHeader->type }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 description_padding_left">
                        <div class="form-group">
                            <label for="description" class="col-md-12 col-form-label">@lang('Description')</label>
                            <div class="description_padding_left_e">{{ str_replace(["script"], ["noscript"], $accountHeader->description) }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">@lang('Status')</label>
                            <p>
                                @if($accountHeader->status == '1')
                                    <span class="badge badge-pill badge-success">@lang('Active')</span>
                                @else
                                    <span class="badge badge-pill badge-danger">@lang('Inactive')</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
