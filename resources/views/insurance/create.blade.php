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
                        <a href="{{ route('insurances.index') }}">@lang('Insurance')</a></li>
                    <li class="breadcrumb-item active">@lang('Add Insurance')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Insurance')</h3>
            </div>
            <div class="card-body">
                <form id="insuranceForm" class="form-material form-horizontal" action="{{ route('insurances.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">@lang('Insurance Name') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Insurance Name')" required>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="service_tax">@lang('Service Tax')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input type="number" id="service_tax" name="service_tax" value="{{ old('service_tax') }}" class="form-control @error('service_tax') is-invalid @enderror" placeholder="@lang('Service Tax')">
                                    @error('service_tax')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">@lang('Discount')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input type="number" id="discount" name="discount" value="{{ old('discount') }}" class="form-control @error('discount') is-invalid @enderror" placeholder="@lang('Discount')">
                                    @error('discount')
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
                                <label for="insurance_no">@lang('Insurance Number')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                    </div>
                                    <input type="text" id="insurance_no" name="insurance_no" value="{{ old('insurance_no') }}" class="form-control @error('insurance_no') is-invalid @enderror" placeholder="@lang('Insurance Number')">
                                    @error('insurance_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_code">@lang('Insurance Code')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                                    </div>
                                    <input type="text" id="insurance_code" name="insurance_code" value="{{ old('insurance_code') }}" class="form-control @error('insurance_code') is-invalid @enderror" placeholder="@lang('Insurance Code')">
                                    @error('insurance_code')
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
                            <table id="custom-color-th" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('Disease Name')</th>
                                        <th scope="col">@lang('Disease Charge')</th>
                                        <th scope="col" class="custom-white-space">@lang('Add / Remove')</th>
                                    </tr>
                                </thead>
                                @if (old('disease_name'))
                                    @foreach (old('disease_name') as $key => $value)
                                        <tr>
                                            <td>
                                                <input type="text" name="disease_name[]" class="form-control" value="{{ old('disease_name')[$key] }}" placeholder="Disease Name">
                                            </td>
                                            <td>
                                                <input type="text" name="disease_type[]" class="form-control" value="{{ old('disease_type')[$key] }}" placeholder="Disease Type">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tbody id="disease">
                                    <tr>
                                      <td>
                                          <input type="text" name="disease_name[]" class="form-control" value="" placeholder="@lang('Disease Name')">
                                      </td>
                                      <td>
                                          <input type="text" name="disease_type[]" class="form-control" value="" placeholder="@lang('Disease Type')">
                                      </td>
                                      <td>
                                          <button type="button" class="btn btn-info m-add"><i class="fas fa-plus"></i></button>
                                          <button type="button" class="btn btn-info m-remove"><i class="fas fa-trash"></i></button>
                                      </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hospital_rate">@lang('Hospital Rate')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-laravel"></i></span>
                                    </div>
                                    <input type="number" id="hospital_rate" name="hospital_rate" value="{{ old('hospital_rate') }}" class="form-control @error('hospital_rate') is-invalid @enderror" placeholder="@lang('Hospital Rate')">
                                    @error('hospital_rate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_rate">@lang('Insurance Rate')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input type="number" id="insurance_rate" name="insurance_rate" value="{{ old('insurance_rate') }}" class="form-control @error('insurance_rate') is-invalid @enderror" placeholder="@lang('Insurance Rate')">
                                    @error('insurance_rate')
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
                                <label for="total">@lang('Total')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                    </div>
                                    <input type="number" id="total" name="total" value="{{ old('total') }}" class="form-control @error('total') is-invalid @enderror" placeholder="@lang('Total')">
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="status">@lang('Status')</label>
                            <div class="form-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                </div>
                                <select class="form-control ambitious-form-loading @error('status') is-invalid @enderror" required="required" name="status" id="status">
                                    <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>@lang('Active')</option>
                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>@lang('Inactive')</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 description_padding_left">
                            <div class="form-group">
                                <label for="description" class="col-md-12 col-form-label">@lang('Description')</label>
                                <div class="col-md-12">
                                    <div id="description" class="form-control description-min-height @error('description') is-invalid @enderror"></div>
                                    <textarea id="dText" class="custom-display-none" name="description">{{ old('description') }}</textarea>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('insurances.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('assets/js/custom/insurance.js') }}"></script>
@endpush
