@extends('layouts.layout')

@push('header')
    <meta name="warning-template-first" content="{{ __("Select SMS Template First") }}">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('sms-campaigns.index') }}">@lang('SMS Campaign')</a></li>
                    <li class="breadcrumb-item active">@lang('Add SMS Campaign')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add SMS Campaign')</h3>
            </div>
            <div class="card-body">
                <form id="smsCampaignForm" class="form-material form-horizontal" action="{{ route('sms-campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="campaign_name">@lang('Campaign Name') <b class="ambitious-crimson">*</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" id="campaign_name" name="campaign_name" value="{{ old('campaign_name') }}" class="form-control @error('campaign_name') is-invalid @enderror" placeholder="@lang('Campaign Name')" required>
                                    @error('campaign_name')
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
                                <label for="contact_type">@lang('Select Group') <b class="ambitious-crimson">*</b></label>
                                <select name="contact_type" id="contact_type" class="form-control custom-width-100 select2 @error('contact_type') is-invalid @enderror" required>
                                    <option value="">--@lang('Select')--</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $value }}" @if($value == old('contact_type')) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('contact_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sms_template_id">@lang('Select Template') </label>
                                <select name="sms_template_id" id="sms_template_id" class="form-control custom-width-100 select2 @error('sms_template_id') is-invalid @enderror">
                                    <option value="">--@lang('Select')--</option>
                                    @foreach ($smsTemplates as $smsTemplate)
                                        <option value="{{ $smsTemplate->id }}" @if($smsTemplate->id == old('sms_template_id')) selected @endif>{{ $smsTemplate->name }}</option>
                                    @endforeach
                                </select>
                                @error('sms_template_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">@lang('Message') <b class="ambitious-crimson">*</b></label>
                                <br>
                                <span class="hide_in_read">
                                    <a id="textarea_name" class="btn btn-default btn-sm">#NAME#</a>
                                    <a id="textarea_phone" class="btn btn-default btn-sm">#PHONE#</a>
                                    <a id="textarea_email_address" class="btn btn-default btn-sm">#Email_ADDRESS#</a>
                                </span>
                                <div class="input-group mb-3">
                                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="@lang('Message Body')" required>{{ old('template') }}</textarea>
                                    @error('message')
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
                                <label>Schedule</label><br/>
                                <input name="schedule_type" value="now" id="schedule_now" class="@error('schedule_type') is-invalid @enderror" checked type="radio"> Now &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="schedule_type" value="later" id="schedule_later" class="@error('schedule_type') is-invalid @enderror" type="radio"> Later
                                @error('schedule_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group schedule_block_item">
                                <label>Schedule time</label>
                                <input placeholder="Time"  name="schedule_time" id="schedule_time" class="form-control flatpickr-date-time @error('schedule_time') is-invalid @enderror" type="text"/>
                                @error('schedule_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-8">
                                    <input id="submit_campaign" type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('sms-campaigns.index') }}" class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('assets/js/custom/sms-campaign.js') }}"></script>
@endpush
