<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-globe"></i> @lang('Go to website')</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown nav-margin">
            <a class="nav-link dropdown-toggle profile-pic login_profile mr-2 p-0" data-toggle="dropdown" href="#">
                <img src="{{ asset($companySettings->company_logo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{ \Illuminate\Support\Str::limit($company_full_name, 20, '...') }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                @foreach ($companySwitchingInfo as $key => $value)
                    <a href="{{ route('company.companyAccountSwitch', ['company_switch' => $key]  ) }}" class="dropdown-item" @if ($key == Session::get('companyInfo')) @endif>
                        <i class="fas fa-building mr-2"></i> {{ \Illuminate\Support\Str::limit($value, 20, '...') }}
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('company.index') }}" class="dropdown-item"><i class="fa fa-sliders-h mr-2"></i> {{ __('Manage Company') }}</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            @php
                $locale = App::getLocale();
            @endphp
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @foreach ($getLang as $key => $value)
                    @if($locale == $key)
                        <span  class="flag-icon {{ $flag[$key] }}"> </span> <span id="ambitious-flag-name-id">{{ $value }}</span> </a>
                    @endif
            @endforeach
            <div class="dropdown-menu" aria-labelledby="dropdown09">
                @foreach ($getLang as $key => $value)
                       <a class="dropdown-item" href="{{ route('lang.index', ['language' => $key]) }}" @if ($key == $locale) @endif><span class="flag-icon {{ $flag[$key] }}"> </span>  {{ $value }}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item dropdown">
            <?php
                if(Auth::user()->photo == NULL)
                {
                    $photo = "assets/images/profile/male.png";
                } else {
                    $photo = Auth::user()->photo;
                }
            ?>
            <a class="nav-link dropdown-toggle profile-pic login_profile p-0" data-toggle="dropdown" href="#">
                <img src="{{ asset($photo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{  strtok(Auth::user()->name, " ") }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dw-user-box">
                    <div class="u-img"><img src="{{ asset($photo) }}" alt="user" /></div>
                    <div class="u-text">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-muted" class="custom-padding-bottom-5">{{ \Illuminate\Support\Str::limit(Auth::user()->email, 17) }}</p>
                        <a href="{{ route('profile.view') }}" class="btn btn-rounded btn-danger btn-sm">{{ __('View Profile') }}</a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.view') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> {{ __('My Profile') }}
                </a>
                <a href="{{ route('profile.setting') }}" class="dropdown-item">
                    <i class="fas fa-cogs mr-2"></i> {{ __('Account Setting') }}
                </a>
                <a href="{{ route('profile.password') }}" class="dropdown-item">
                    <i class="fa fa-key mr-2"></i></i> {{ __('Change Password') }}
                </a>
                <div class="dropdown-divider"></div>
                <a id="header-logout" href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off mr-2"></i> {{ __('Logout') }}</a>
                <form id="logout-form" class="ambitious-display-none" action="{{ route('logout') }}" method="POST">@csrf</form>
            </div>
        </li>
    </ul>
</nav>
<script src="{{ asset('assets/js/custom/layouts/header.js') }}"></script>
