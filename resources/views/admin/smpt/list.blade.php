@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('smtp-create')
                    <h3>
                        <a href="{{ route('smtp-configurations.create') }}" class="btn btn-outline btn-info">+ {{ __('Add New SMTP') }}</a>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('SMTP List') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('SMTP Configrution') }}</h3>
        </div>
        <div class="card-body">
            <table id="laravel_datatable" class="table table-striped compact table-width">
                <thead>
                    <tr>
                        <th>{{ __('Id') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Host') }}</th>
                        <th>{{ __('Port') }}</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Password') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th data-orderable="false">{{   __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->sender_name }}</td>
                            <td>{{ $list->sender_email }}</td>
                            <td>{{ $list->smtp_host }}</td>
                            <td>{{ $list->smtp_port }}</td>
                            <td>{{ $list->smtp_user }}</td>
                            <td>{{ $list->smtp_password }}</td>
                            <td>
                                @if($list->smtp_type == 'ssl')
                                    <span class="badge badge-pill badge-info">@lang('Ssl')</span>
                                @elseif($list->smtp_type == 'tls')
                                    <span class="badge badge-pill badge-success">@lang('Tls')</span>
                                @else
                                    <span class="badge badge-pill badge-secondary">@lang('Default')</span>
                                @endif
                            </td>
                            <td>
                                @if($list->status == 0)
                                    <span class="badge badge-pill badge-secondary">@lang('Inactive')</span>
                                @else
                                    <span class="badge badge-pill badge-primary">@lang('Active')</span>
                                @endif
                            </td>
                            <td>
                                @can('smtp-update')
                                    <a href="{{ route('smtp-configurations.edit', $list) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endcan
                                @can('smtp-delete')
                                    <a href="#" data-href="{{ route('smtp-configurations.destroy', $list) }}" class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lists->links() }}
        </div>
      </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection
