@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front-ends.index') }}">@lang('Front-ends')</a></li>
                        <li class="breadcrumb-item active">@lang(ucfirst($frontEnd->page))</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Edit '.ucfirst($frontEnd->page))</h3>
                </div>
                <div class="card-body">
                    <form id="departmentForm" class="form-material form-horizontal" action="{{ route('front-ends.updateServices', $frontEnd) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fab fa-servicestack"></i> @lang('Our Services')</legend>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Description') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('serviceText') is-invalid @enderror" name="serviceText" required>{{ old('serviceText', $contents->serviceText) }}</textarea>
                                            @error('serviceText')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="services">
                                <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="custom-th-width-20">@lang('Image')</th>
                                                <th class="custom-th-width-15">@lang('Name')</th>
                                                <th>@lang('Description')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = -1;
                                            @endphp
                                            @foreach ($contents->serviceName ?? [] as $team)
                                                @php
                                                    $i++;
                                                    if (empty($contents->serviceName[$i]))
                                                        continue;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="images[]" value="{{ $contents->images[$i] ?? '' }}">
                                                        <img id="frontend-services-max" src="{{ asset($contents->images[$i] ?? 'assets/images/placeholder.jpg') }}" alt="" class="img-fluid">
                                                        <input type="file" class="form-control custom-padding-three" name="image_files[]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="serviceName[]" value="{{ $contents->serviceName[$i] }}" required>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="serviceDescription[]" cols="30" rows="3" required>{{ $contents->serviceDescription[$i] }}</textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fas fa-list"></i> @lang('Some More Features')</legend>
                            <div class="row">
                                <div class="col-md-12 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Description') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('feature') is-invalid @enderror" name="feature" required>{{ old('feature', $contents->feature) }}</textarea>
                                            @error('feature')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Free Check Up') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('check') is-invalid @enderror" name="check" required>{{ old('check', $contents->check) }}</textarea>
                                            @error('check')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Always Open') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('open') is-invalid @enderror" name="open" required>{{ old('open', $contents->open) }}</textarea>
                                            @error('open')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Serve with Smile') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('smile') is-invalid @enderror" name="smile" required>{{ old('smile', $contents->smile) }}</textarea>
                                            @error('smile')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Work with Hearts') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control @error('work') is-invalid @enderror" name="work" required>{{ old('work', $contents->work) }}</textarea>
                                            @error('work')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-form-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" value="@lang('Submit')" class="btn btn-outline btn-info btn-lg">
                                        <a href="{{ route('front-ends.index') }}" class="btn btn-outline btn-warning btn-lg">@lang('Cancel')</a>
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
