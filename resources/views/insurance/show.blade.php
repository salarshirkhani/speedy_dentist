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
                <h3 class="card-title">@lang('Insurance')</h3>
                <div class="card-tools">
                    <a href="{{ route('insurances.edit', $insurance) }}" class="btn btn-info">@lang('Edit')</a>
                </div>
            </div>
            <div class="card-body">
                <form id="insuranceForm" class="form-material form-horizontal" action="#" method="#" enctype="">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">@lang('Insurance Name') : </label> <span>{{ $insurance->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="service_tax">@lang('Service Tax') : </label> <span>{{ $insurance->service_tax }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">@lang('Discount') : </label> <span>{{$insurance->discount}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_no">@lang('Insurance Number') : </label> <span>{{ $insurance->insurance_no }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_code">@lang('Insurance Code') : </label> <span>{{ $insurance->insurance_code }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped custom-color-th">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('Disease Name')</th>
                                        <th scope="col">@lang('Disease Charge')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(json_decode($insurance->disease_charge) as $diseaseCharge)
                                        <tr>
                                            <td>{{ $diseaseCharge->disease_name }}</td>
                                            <td>{{ $diseaseCharge->disease_type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hospital_rate">@lang('Hospital Rate') : </label> <span>{{ $insurance->hospital_rate }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_rate">@lang('Insurance Rate') : </label> <span>{{ $insurance->insurance_rate }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total">@lang('Total') : </label> <span>{{ $insurance->total }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">@lang('Status') : </label> @if($insurance->status === '1') {{ "Active" }} @else {{ "Inactive" }} @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">@lang('Description')</label>
                                <p>{!! str_replace(["script"], ["noscript"], $insurance->description) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
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
    <script src="{{ asset('assets/js/custom/insurance/edit.js') }}"></script>
@endpush
