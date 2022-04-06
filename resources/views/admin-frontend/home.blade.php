
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
                <form id="departmentForm" class="form-material form-horizontal" action="{{ route('front-ends.updateHome', $frontEnd) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-heading"></i> @lang('Header')</legend>
                        <div class="row">
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Header Top Address') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="topAddress" value="{{ $contents->topAddress ?? '' }}" required>
                                        @error('topAddress')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Header Top Email') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="topEmail" value="{{ $contents->topEmail ?? '' }}" required>
                                        @error('topEmail')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Header question call') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="questionCall" value="{{ $contents->questionCall ?? '' }}" required>
                                        @error('questionCall')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-hashtag"></i> @lang('Banner')</legend>
                        <div class="row">
                            <div class="col-md-6 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Head Line') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('headline') is-invalid @enderror" name="headline" rows="4" required>{{ old('headline', $contents->headline) }}</textarea>
                                        @error('headline')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Tag Line') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('tagline') is-invalid @enderror" name="tagline" rows="4" required>{{ old('tagline', $contents->tagline) }}</textarea>
                                        @error('tagline')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-arrows-alt"></i> @lang('We are Here')</legend>
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('We are Here Welcome text') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="welcome" value="{{ $contents->welcome ?? '' }}" required>
                                        @error('welcome')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Welcome text description one') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('welCol1') is-invalid @enderror" name="welCol1" rows="4" required>{{ old('welCol1', $contents->welCol1) }}</textarea>
                                        @error('welCol1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Welcome text description two') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('welCol2') is-invalid @enderror" name="welCol2" rows="4" required>{{ old('welCol2', $contents->welCol2) }}</textarea>
                                        @error('welCol2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-smile-beam"></i> @lang('For a New smile')</legend>
                        <div class="row">
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Heading') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="caring" value="{{ $contents->caring ?? '' }}" required>
                                        @error('caring')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Daily appointments count') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="appointmentCount" value="{{ $contents->appointmentCount ?? '' }}" required>
                                        @error('appointmentCount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Happy clients count') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="clientCount" value="{{ $contents->clientCount ?? '' }}" required>
                                        @error('clientCount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('For a New smile discription') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('caringText') is-invalid @enderror" name="caringText" rows="4" required>{{ old('caringText', $contents->caringText) }}</textarea>
                                        @error('caringText')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Daily appointments discription') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('appointmentText') is-invalid @enderror" name="appointmentText" rows="4" required>{{ old('appointmentText', $contents->appointmentText) }}</textarea>
                                        @error('appointmentText')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Happy Clients discription') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('clientText') is-invalid @enderror" name="clientText" rows="4" required>{{ old('clientText', $contents->clientText) }}</textarea>
                                        @error('clientText')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-tooth"></i> @lang('Dental Health Services')</legend>
                        <div class="row">
                            @foreach ($contents->services ?? [] as $service)
                                @continue(empty($service))
                                <div id="frontend-home-bottom-important" class="col-md-6">
                                    <input type="text" class="form-control" name="services[]" value="{{ $service }}" required>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fab fa-dochub"></i> @lang('Testimonials')</legend>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="custom-th-width-30">@lang('Image')</th>
                                        <th class="custom-th-width-20">@lang('Name')</th>
                                        <th class="custom-th-width-20">@lang('Company Name')</th>
                                        <th class="custom-th-width-30">@lang('Discription')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
								    $i = -1;
                                    @endphp
                                    @foreach ($contents->review ?? [] as $review)
                                        @php
                                            $i++;
                                            if (empty($contents->review[$i]) || empty($contents->reviewText[$i]))
                                                continue;
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="hidden" name="images[]" value="{{ $contents->images[$i] ?? '' }}">
                                                <img id="frontend-img-placeholder-height" src="{{ asset($contents->images[$i] ?? 'assets/images/placeholder.jpg') }}" alt="" class="img-fluid">
                                                <input type="file" class="custom-padding-three" name="image_files[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="review[]" value="{{ $contents->review[$i] }}" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="company[]" value="{{ $contents->company[$i] }}" required>
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="reviewText[]" cols="30" rows="3" required>{{ $contents->reviewText[$i] }}</textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-shoe-prints"></i> @lang('Footer')</legend>
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Bottom Tag Line') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('bottomTagLine') is-invalid @enderror" name="bottomTagLine" required>{{ old('bottomTagLine', $contents->bottomTagLine) }}</textarea>
                                        @error('bottomTagLine')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fab fa-facebook"></i> @lang('Social Network')</legend>
                            <div class="row">
                                <div class="col-md-4 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Facebook') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="facebook" value="{{ $contents->facebook ?? '' }}" required>
                                            @error('facebook')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Twitter') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="twitter" value="{{ $contents->twitter ?? '' }}" required>
                                            @error('twitter')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Google') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="google" value="{{ $contents->google ?? '' }}" required>
                                            @error('google')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="custom-fieldset-padding-border-radius">
                            <legend class="custom-legend-width-auto"><i class="fas fa-hourglass-start"></i> @lang('Working Hours')</legend>
                            <div class="row">
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Monday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="monday_s" value="{{ $contents->monday_s ?? '' }}" required>
                                            @error('monday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Tuesday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="tuesday_s" value="{{ $contents->tuesday_s ?? '' }}" required>
                                            @error('tuesday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Wednesday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="wednesday_s" value="{{ $contents->wednesday_s ?? '' }}" required>
                                            @error('wednesday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Thursday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="thursday_s" value="{{ $contents->thursday_s ?? '' }}" required>
                                            @error('thursday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Friday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="friday_s" value="{{ $contents->friday_s ?? '' }}" required>
                                            @error('friday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Saturday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="saturday_s" value="{{ $contents->saturday_s ?? '' }}" required>
                                            @error('saturday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 description_padding_left">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label">@lang('Sunday') <b class="ambitious-crimson">*</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="sunday_s" value="{{ $contents->sunday_s ?? '' }}" required>
                                            @error('sunday_s')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
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
