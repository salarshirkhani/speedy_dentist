@extends('layouts.layout')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('tax-rate-create')
                    <h3>
                        <a href="{{ route('tax.create') }}" class="btn btn-outline btn-info">+ {{ __('Add New') }}</a>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Tax Rates') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Tax Rates') }} </h3>
                <div class="card-tools">
                    <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                </div>
            </div>
            <div class="card-body">
                <div id="filter" class="collapse @if(request()->isFilterActive) show @endif">
                    <div class="card-body border">
                        <form action="" method="get" role="form" autocomplete="off">
                            <input type="hidden" name="isFilterActive" value="true">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Tax Name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ request()->name }}" placeholder="@lang('Tax Name')">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Tax Type')</label>
                                        <select class="form-control" name="type">
                                            <option value="">--@lang('Select')--</option>
                                            <option value="inclusive" {{ old('type', request()->type) === 'inclusive' ? 'selected' : ''  }}>@lang('Inclusive')</option>
                                            <option value="exclusive" {{ old('type', request()->type) === 'exclusive' ? 'selected' : ''  }}>@lang('Exclusive')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('tax.index') }}" class="btn btn-secondary">@lang('Clear')</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table id="laravel_datatable" class="table table-striped compact table-width">
                    <thead>
                        <tr>
                            <th>{{ __('Tax Name') }}</th>
                            <th>{{ __('Tax Rate(%)') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th data-orderable="false">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taxes as $tax)
                            <tr>
                                <td>{{ $tax->name }}</td>
                                <td>{{ $tax->rate }}</td>
                                <td>
                                    @if($tax->type == 'inclusive')
                                        <span class="badge badge-pill badge-primary">@lang('Inclusive')</span>
                                    @elseif ($tax->type == 'exclusive')
                                        <span class="badge badge-pill badge-warning">@lang('Exclusive')</span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">@lang('Normal')</span>
                                    @endif
                                </td>
                                <td>
                                    @if($tax->enabled == '1')
                                        <span class="badge badge-pill badge-success">@lang('Enabled')</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">@lang('Disabled')</span>
                                    @endif
                                </td>
                                <td>
                                    @can('tax-rate-update')
                                        <a href="{{ route('tax.edit', $tax) }}" class="btn btn-info btn-circle" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                    @endcan
                                    @can('tax-rate-delete')
                                        <a href="#" data-href="{{ route('tax.destroy', $tax) }}" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal" title="@lang('Delete')"><i class="fa fa-trash ambitious-padding-btn"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $taxes->links() }}
            </div>
      </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection

