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
                <form id="departmentForm" class="form-material form-horizontal" action="{{ route('front-ends.updateAbout', $frontEnd) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset class="custom-fieldset-padding-border-radius">
                        <legend class="custom-legend-width-auto"><i class="fas fa-list"></i> @lang('About List')</legend>
                        <div class="row">
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Annual Check-ups') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('aboutAnnualCheck') is-invalid @enderror" name="aboutAnnualCheck" rows="4" required>{{ old('aboutAnnualCheck', $contents->aboutAnnualCheck) }}</textarea>
                                        @error('aboutAnnualCheck')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Work with Hearts') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('aboutWorkHeart') is-invalid @enderror" name="aboutWorkHeart" rows="4" required>{{ old('aboutWorkHeart', $contents->aboutWorkHeart) }}</textarea>
                                        @error('aboutWorkHeart')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Help at Hand') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('aboutHelpHand') is-invalid @enderror" name="aboutHelpHand" rows="4" required>{{ old('aboutHelpHand', $contents->aboutHelpHand) }}</textarea>
                                        @error('aboutHelpHand')
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
                        <legend class="custom-legend-width-auto"><i class="fas fa-hand-pointer"></i> @lang('Why Choose Us')</legend>
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Description') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('aboutWhyChooseUs') is-invalid @enderror" name="aboutWhyChooseUs" required>{{ old('aboutWhyChooseUs', $contents->aboutWhyChooseUs) }}</textarea>
                                        @error('aboutWhyChooseUs')
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
                        <legend class="custom-legend-width-auto"><i class="fab fa-teamspeak"></i> @lang('Our Team')</legend>
                        <div class="row">
                            <div class="col-md-12 description_padding_left">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">@lang('Description') <b class="ambitious-crimson">*</b></label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('aboutOurTeam') is-invalid @enderror" name="aboutOurTeam" rows="4" required>{{ old('aboutOurTeam', $contents->aboutOurTeam) }}</textarea>
                                        @error('aboutOurTeam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="about">
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="custom-th-width-30">@lang('Image')</th>
                                            <th class="custom-th-width-15">@lang('Name')</th>
                                            <th>@lang('Designation')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = -1;
                                        @endphp
                                        @foreach ($contents->teams ?? [] as $team)
                                            @php
                                                $i++;
                                                if (empty($contents->teams[$i]) || empty($contents->teamPost[$i]))
                                                    continue;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="images[]" value="{{ $contents->images[$i] ?? '' }}">
                                                    <img id="frontend-img-placeholder" src="{{ asset($contents->images[$i] ?? 'assets/images/placeholder.jpg') }}" alt="" class="img-fluid">
                                                    <input type="file" class="custom-padding-three" name="image_files[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="teams[]" value="{{ $contents->teams[$i] }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="teamPost[]" value="{{ $contents->teamPost[$i] }}" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
