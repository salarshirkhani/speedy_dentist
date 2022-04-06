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
                        <a href="{{ route('payments.index') }}">@lang('Payment')</a></li>
                    <li class="breadcrumb-item active">@lang('Add Payment')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Payment')</h3>
            </div>
            <div class="card-body">
                <form id="accountForm" class="form-material form-horizontal" action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="payment_date">@lang('Payment Date') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="text" id="payment_date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" class="form-control flatpickr @error('payment_date') is-invalid @enderror" placeholder="@lang('Payment Date')" required>
                                    @error('payment_date')
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
                            <div class="form-group">
                                <label for="receiver_name">@lang('Receiver Name') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}" class="form-control @error('receiver_name') is-invalid @enderror" placeholder="@lang('Receiver Name')" required>
                                    @error('receiver_name')
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
                            <div class="form-group">
                                <label for="account_name">@lang('Account Name') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                    </div>
                                    <select class="form-control select2 @error('account_name') is-invalid @enderror" required name="account_name" id="account_name">
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($accountHeaders as $accountHeader)
                                            <option value="{{ $accountHeader->id }}" @if(old('account_name') == $accountHeader->id) selected @endif>{{ $accountHeader->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('account_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount">@lang('Amount') <b class="ambitious-crimson">*</b></label>
                                <div class="form-group input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" placeholder="@lang('Amount')" required>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                            <a href="{{ route('payments.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('assets/js/custom/payments.js') }}"></script>
@endpush
