@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('email-campaigns.index') }}">@lang('Email Campaign')</a></li>
                    <li class="breadcrumb-item active">@lang('Email Campaign Report')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Email Campaign Report List')</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Created at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emailCampaignReports as $emailCampaignReport)
                        <tr>
                            <td> {{ $emailCampaignReport->user->name }}</td>
                            <td> {{ $emailCampaignReport->user->email }}</td>
                            <td>
                                @if($emailCampaignReport->status == 1)
                                    <h4><span class="badge badge-success">@lang('Send')</span></h4>
                                @else
                                    <h4><span class="badge badge-warning">@lang('Not Send')</span></h4>
                                @endif
                            </td>
                            <td>
                                {{ date('d-m-Y H:i:s', strtotime($emailCampaignReport->created_at)) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
