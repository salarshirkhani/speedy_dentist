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
                        <a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active">@lang('Profile')</li>
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
                    @php
                        if($user->photo == null) {
                            $photo = "assets/images/profile/male.png";
                        } else {
                            $photo = $user->photo;
                        }
                    @endphp
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset($photo) }}" alt="" />
                </div>
                <h3 class="profile-username text-center">{{  strtok(Auth::user()->name, " ") }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Profile Info')</h3>
                <div class="card-tools">
                    <a href="{{ route('profile.setting') }}" class="btn btn-info">@lang('Edit')</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('Name')</label>
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('Phone')</label>
                            <p>{{ $user->phone }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">@lang('Email')</label>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">@lang('Address')</label>
                            <p>{{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
