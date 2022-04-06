@php
    $footers = json_decode(\App\Models\FrontEnd::find(1)->content);
@endphp
<!-- footer -->
<footer class="w3l-footer-66">
    <!-- footer -->
    <div class="footer-66-info">
        <div class="container">
            <div class="row footer-top">
                <div class="col-lg-4 footer-grid_section_w3layouts pr-lg-5">
                    <h2 class="logo-2 mb-lg-4 mb-3">
                        <a class="navbar-brand" href="index.html">{{ $ApplicationSetting->item_name ?? '' }}</a>
                    </h2>
                    <p>{{ $footers->bottomTagLine ?? '' }}</p>
                    <h4 class="sub-con-fo ad-info my-4">@lang('Catch on Social')</h4>
                    <ul class="w3layouts_social_list list-unstyled">
                        <li>
                            <a href="{{ $footers->facebook ?? '' }}" class="w3pvt_facebook">
                                <span class="fab fa-facebook-f"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $footers->twitter ?? '' }}" class="w3pvt_twitter">
                                <span class="fab fa-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $footers->google ?? '' }}" class="w3pvt_google">
                                <span class="fab fa-google-plus-g"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 footer-right">
                    <div id="custom-footer-top" class="bottom-w3layouts-sec-nav">
                        <div class="row sub-content-botom mx-0">
                            <div class="col-md-4 footer-grid_section_w3layouts pl-lg-0">
                                <h3 class="footer-title">@lang('Information')</h3>
                                <ul class="footer list-unstyled">
                                    <li>
                                        <a href="{{ url('/') }}">@lang('Home')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/about') }}">@lang('About Us')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/services') }}">@lang('Services')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/contact') }}">@lang('Contact Us')</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 footer-grid_section_w3layouts">
                            </div>
                            <div class="col-md-4 footer-grid_section_w3layouts ">
                                <h3 class="footer-title">@lang('Working Hours')</h3>
                                <ul class="wrk-schedule-block">
                                    <li>@lang('Monday')<span class="schedule-time">{{ $footers->monday_s ?? '' }}</span></li>
                                    <li>@lang('Tuesday')<span class="schedule-time">{{ $footers->tuesday_s ?? '' }}</span></li>
                                    <li>@lang('Wednesday')<span class="schedule-time">{{ $footers->wednesday_s ?? '' }}</span></li>
                                    <li>@lang('Thursday')<span class="schedule-time">{{ $footers->thursday_s ?? '' }}</span></li>
                                    <li>@lang('Friday')<span class="schedule-time">{{ $footers->friday_s ?? '' }}</span></li>
                                    <li>@lang('Saturday')<span class="schedule-time">{{ $footers->saturday_s ?? '' }}</span></li>
                                    <li>@lang('Sunday')<span class="schedule-time">{{ $footers->sunday_s ?? '' }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cpy-right py-3">
        <p class="text-center">Copyright © {{ date('Y') }} iDentSoft. All rights reserved | Developed by
            <a href="https://ambitiousit.net" target="_blank"> ambitiousit.</a>
        </p>
    </div>
    <!-- move top -->
    <button id="movetop" title="Go to top">
        <span class="fas fa-level-up-alt"></span>
    </button>
</footer>
<!--//footer -->
