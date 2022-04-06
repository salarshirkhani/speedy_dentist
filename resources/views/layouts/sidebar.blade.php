@php
$c = Request::segment(1);
$m = Request::segment(2);
$roleName = Auth::user()->getRoleNames();
@endphp

<aside class="main-sidebar sidebar-light-info elevation-4">
    <a href="{{ route('dashboard')  }}" class="brand-link sidebar-light-info">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="{{ $ApplicationSetting->item_name }}" id="custom-opacity-sidebar" class="brand-image">
        <span class="brand-text font-weight-light">{{ $ApplicationSetting->item_name }}</span>
    </a>
    <div class="sidebar">
        <?php
            if(Auth::user()->photo == NULL)
            {
                $photo = "assets/images/profile/male.png";
            } else {
                $photo = Auth::user()->photo;
            }
        ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset($photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info my-auto">
                {{ Auth::user()->name }}
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if($c == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                @canany(['hospital-department-read', 'hospital-department-create', 'hospital-department-update', 'hospital-department-delete'])
                    <li class="nav-item">
                        <a href="{{ route('hospital-departments.index') }}" class="nav-link @if($c == 'hospital-departments') active @endif">
                            <i class="nav-icon fas fa-bezier-curve"></i>
                            <p>@lang('Hospital Departments')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['doctor-detail-read', 'doctor-detail-create', 'doctor-detail-update', 'doctor-detail-delete'])
                    <li class="nav-item">
                        <a href="{{ route('doctor-details.index') }}" class="nav-link @if($c == 'doctor-details') active @endif">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>@lang('Doctor')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['patient-detail-read', 'patient-detail-create', 'patient-detail-update', 'patient-detail-delete'])
                    <li class="nav-item">
                        <a href="{{ route('patient-details.index') }}" class="nav-link @if($c == 'patient-details') active @endif">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>@lang('Patient')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['doctor-schedule-read', 'doctor-schedule-create', 'doctor-schedule-update', 'doctor-schedule-delete'])
                    <li class="nav-item">
                        <a href="{{ route('doctor-schedules.index') }}" class="nav-link @if($c == 'doctor-schedules') active @endif">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>@lang('Doctor Schedule')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['patient-appointment-read', 'patient-appointment-create', 'patient-appointment-update', 'patient-appointment-delete'])
                    <li class="nav-item">
                        <a href="{{ route('patient-appointments.index') }}" class="nav-link @if($c == 'patient-appointments') active @endif">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>@lang('Patient Appointment')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['patient-case-studies-read', 'patient-case-studies-create', 'patient-case-studies-update', 'patient-case-studies-delete'])
                    <li class="nav-item">
                        <a href="{{ route('patient-case-studies.index') }}" class="nav-link @if($c == 'patient-case-studies') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>@lang('Patient Case Studies')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['prescription-read', 'prescription-create', 'prescription-update', 'prescription-delete'])
                    <li class="nav-item">
                        <a href="{{ route('prescriptions.index') }}" class="nav-link @if($c == 'prescriptions') active @endif">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>@lang('Prescription')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['insurance-read', 'insurance-create', 'insurance-update', 'insurance-delete'])
                    <li class="nav-item">
                        <a href="{{ route('insurances.index') }}" class="nav-link @if($c == 'insurances') active @endif">
                            <i class="nav-icon fab fa-hire-a-helper"></i>
                            <p>@lang('Insurances')</p>
                        </a>
                    </li>
                @endcanany

                @canany(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete', 'lab-report-template-read', 'lab-report-template-create', 'lab-report-template-update', 'lab-report-template-delete'])
                    <li class="nav-item has-treeview @if($c == 'lab-reports' || $c == 'lab-report-templates') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if($c == 'lab-reports' || $c == 'lab-report-templates') active @endif">
                            <i class="nav-icon fas fa-flask"></i>
                            <p>
                                @lang('Lab')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['lab-report-read', 'lab-report-create', 'lab-report-update', 'lab-report-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('lab-reports.index') }}" class="nav-link @if($c == 'lab-reports') active @endif">
                                        <i class="nav-icon fas fa-vial"></i>
                                        <p>@lang('Lab Report')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['lab-report-template-read', 'lab-report-template-create', 'lab-report-template-update', 'lab-report-template-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('lab-report-templates.index') }}" class="nav-link @if($c == 'lab-report-templates') active @endif">
                                        <i class="nav-icon fas fa-crop-alt"></i>
                                        <p>@lang('Lab Report Templates')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['account-header-read', 'account-header-create', 'account-header-update', 'account-header-delete', 'payment-read', 'payment-create', 'payment-update', 'payment-delete', 'invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete', 'financial-report-read'])
                    <li class="nav-item has-treeview @if($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if($c == 'account-headers' || $c == 'invoices' || $c == 'payments' || $c == 'financial-reports') active @endif">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>
                                @lang('Financial Activities')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['account-header-read', 'account-header-create', 'account-header-update', 'account-header-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('account-headers.index') }}" class="nav-link @if($c == 'account-headers') active @endif ">
                                        <i class="fas fa-comment-dollar"></i>
                                        <p>@lang('Account Header')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['invoice-read', 'invoice-create', 'invoice-update', 'invoice-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('invoices.index') }}" class="nav-link @if($c == 'invoices') active @endif ">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <p>@lang('Invoice')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['payment-read', 'payment-create', 'payment-update', 'payment-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('payments.index') }}" class="nav-link @if($c == 'payments') active @endif ">
                                        <i class="fas fa-money-check"></i>
                                        <p>@lang('Payment')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['financial-report-read'])
                                <li class="nav-item">
                                    <a href="{{ route('financial-reports.index') }}" class="nav-link @if($c == 'financial-reports') active @endif ">
                                        <i class="fas fa-folder-open"></i>
                                        <p>@lang('Report')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['front-end-read', 'front-end-create', 'front-end-update', 'front-end-delete'])
                    <li class="nav-item">
                        <a href="{{ route('front-ends.index') }}" class="nav-link @if($c == 'front-ends') active @endif">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>@lang('Front-ends')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['contact-us-read', 'contact-us-delete'])
                    <li class="nav-item">
                        <a href="{{ route('contacts.index') }}" class="nav-link @if($c == 'contacts') active @endif">
                            <i class="nav-icon far fa-address-book"></i>
                            <p>@lang('Contact Us')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['email-template-read', 'email-template-create', 'email-template-update', 'email-template-delete', 'email-campaign-read', 'email-campaign-create', 'email-campaign-update', 'email-campaign-delete'])
                    <li class="nav-item has-treeview @if($c == 'email-templates' || $c == 'email-campaigns') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if($c == 'email-templates' || $c == 'email-campaigns') active @endif">
                            <i class="nav-icon fas fa-envelope-open-text"></i>
                            <p>
                                @lang('Email')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['email-template-read', 'email-template-create', 'email-template-update', 'email-template-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('email-templates.index') }}" class="nav-link @if($c == 'email-templates') active @endif ">
                                        <i class="fas fa-crop-alt"></i>
                                        <p>@lang('Email Tempaltes')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['email-campaign-read', 'email-campaign-create', 'email-campaign-update', 'email-campaign-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('email-campaigns.index') }}" class="nav-link @if($c == 'email-campaigns') active @endif ">
                                        <i class="fas fa-bullhorn"></i>
                                        <p>@lang('Email Campaigns')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['sms-api-read', 'sms-api-create', 'sms-api-update', 'sms-api-delete', 'sms-template-read', 'sms-template-create', 'sms-template-update', 'sms-template-delete','sms-campaign-read', 'sms-campaign-create', 'sms-campaign-update', 'sms-campaign-delete'])
                    <li class="nav-item has-treeview @if($c == 'sms-apis' || $c == 'sms-templates' || $c == 'sms-campaigns') menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if($c == 'sms-apis' || $c == 'sms-templates' || $c == 'sms-campaigns') active @endif">
                            <i class="nav-icon fas fa-sms"></i>
                            <p>
                                @lang('SMS')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['sms-api-read', 'sms-api-create', 'sms-api-update', 'sms-api-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('sms-apis.index') }}" class="nav-link @if($c == 'sms-apis') active @endif ">
                                        <i class="fas fa-map-signs"></i>
                                        <p>@lang('SMS Gateway')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['sms-template-read', 'sms-template-create', 'sms-template-update', 'sms-template-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('sms-templates.index') }}" class="nav-link @if($c == 'sms-templates') active @endif ">
                                        <i class="fas fa-crop-alt"></i>
                                        <p>@lang('SMS Tempaltes')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['sms-campaign-read', 'sms-campaign-create', 'sms-campaign-update', 'sms-campaign-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('sms-campaigns.index') }}" class="nav-link @if($c == 'sms-campaigns') active @endif ">
                                        <i class="fas fa-bullhorn"></i>
                                        <p>@lang('SMS Campaigns')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['role-read', 'role-create', 'role-update', 'role-delete', 'user-read', 'user-create', 'user-update', 'user-delete', 'smtp-read', 'smtp-create', 'smtp-update', 'smtp-delete','company-read', 'company-create', 'company-update', 'company-delete', 'currencies-read', 'currencies-create', 'currencies-update', 'currencies-delete','tax-rate-read', 'tax-rate-create', 'tax-rate-update', 'tax-rate-delete'])
                    <li class="nav-item has-treeview @if($c == 'roles' || $c == 'users' || $c == 'apsetting' || $c == 'smtp-configurations' || $c == 'general' || $c == 'currency' || $c == 'tax' ) menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if($c == 'roles' || $c == 'users' || $c == 'apsetting' || $c == 'smtp-configurations' || $c == 'general' || $c == 'currency' || $c == 'tax'  ) active @endif">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                @lang('Settings')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['role-read', 'role-create', 'role-update', 'role-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link @if($c == 'roles') active @endif ">
                                        <i class="fas fa-cube nav-icon"></i>
                                        <p>@lang('Role Management')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['user-read', 'user-create', 'user-update', 'user-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link @if($c == 'users') active @endif ">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>@lang('User Management')</p>
                                    </a>
                                </li>
                            @endcanany
                            @if ($roleName['0'] = "Super Admin")
                                <li class="nav-item">
                                    <a href="{{ route('apsetting') }}" class="nav-link @if($c == 'apsetting' && $m == null) active @endif ">
                                        <i class="fa fa-globe nav-icon"></i>
                                        <p>@lang('Application Settings')</p>
                                    </a>
                                </li>
                            @endif
                            @canany(['smtp-read', 'smtp-create', 'smtp-update', 'smtp-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('smtp-configurations.index') }}" class="nav-link @if($c == 'smtp-configurations') active @endif ">
                                        <i class="fas fa-mail-bulk nav-icon"></i>
                                        <p>@lang('SMTP Settings')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['company-read', 'company-create', 'company-update', 'company-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('general') }}" class="nav-link @if($c == 'general') active @endif ">
                                        <i class="fas fa-align-left nav-icon"></i>
                                        <p>@lang('General Settings')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['currencies-read', 'currencies-create', 'currencies-update', 'currencies-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('currency.index') }}" class="nav-link @if($c == 'currency') active @endif ">
                                        <i class="fas fa-coins nav-icon"></i>
                                        <p>@lang('Currencies')</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['tax-rate-read', 'tax-rate-create', 'tax-rate-update', 'tax-rate-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('tax.index') }}" class="nav-link @if($c == 'tax') active @endif ">
                                        <i class="fas fa-percentage nav-icon"></i>
                                        <p>@lang('Tax Rates')</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
    </div>
</aside>
