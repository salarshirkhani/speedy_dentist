@extends('layouts.layout')
@section('one_page_js')
<script src="{{ asset('assets/plugins/magnify/dist/jquery.magnify.js') }}"></script>
@endsection

@section('one_page_css')
     <link href="{{ asset('assets/plugins/magnify/dist/jquery.magnify.css') }}" rel="stylesheet">
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
                        <a href="{{ route('lab-reports.index') }}">@lang('Lab Report')</a></li>
                    <li class="breadcrumb-item active">@lang('Lab Report Info')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ $labReport->user->photo_url }}" alt="">
                </div>
                <h3 class="profile-username text-center">{{ $labReport->user->name }}</h3>
                <p class="text-muted text-center">{{ $labReport->date }}</p>
                <p class="text-center">{{ $labReport->user->phone }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Lab Reports Info')</h3>
                <div class="card-tools">
                    @can('lab-report-update')
                        <a href="{{ route('lab-reports.edit', $labReport) }}" class="btn btn-info">@lang('Edit')</a>
                    @endcan
                    <button id="doPrint" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
            <div class="card-body">
                <div id="print-area" class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <p class="text-right m-0">@lang('Report Date'): {{ date($companySettings->date_format ?? 'Y-m-d', strtotime($labReport->date)) }}<br></p>
                            <p class="text-right">@lang('Lab Report ID') #{{ str_pad($labReport->id, 4, '0', STR_PAD_LEFT) }}<br></p>
                            <h4>
                                <img src="{{ $company->company_logo }}" class="custom-wi-he" alt=""> {{ $company->company_name }}
                            </h4>
                            <div class="row invoice-info">
                                <div class="col-md-12 invoice-col">
                                    <address>
                                        {!! str_replace(["script"], ["noscript"], $company->company_address) !!}
                                        @lang('Email'): {{ $company->company_email }}<br>
                                        @if ($company->company_phone)
                                            @lang('Phone'): {{ $company->company_phone }}
                                        @endif
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2 class="text-center">@lang('Lab Report')</h2>
                        {!! str_replace(["script"], ["noscript"], $labReport->report) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($labReport->photo))
                            @foreach (json_decode($labReport->photo) as $pic)
                                @if(pathinfo($pic, PATHINFO_EXTENSION) != "pdf")
                                    <a data-magnify="gallery" data-caption="Report"
                                        href="{{ asset('storage/'.$pic) }}">
                                        <img id="custom-mw-heo" class="rounded" src="{{ asset('storage/'.$pic) }}" alt="">
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($labReport->photo))
                            @foreach (json_decode($labReport->photo) as $pic)
                                @if(pathinfo($pic, PATHINFO_EXTENSION) == "pdf")
                                    <a class="my_card" href="{{ asset('storage/'.$pic) }}" target="_blank">
                                        <i class="fas fa-file-pdf fa-7x" class="custom-padding-10"></i>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/lab-report/show.js') }}"></script>
@endpush
