<?php

namespace App\Providers;

use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->is('install'))
            return;
        
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {

            if (Schema::hasTable('application_settings')) {
                $application = ApplicationSetting::first();
            } else {
                $application = NULL;
            }

            $getLang = array (
                'en' => 'English',
                'bn' => 'বাংলা',
                'el' => 'Ελληνικά',
                'pt' => 'Português',
                'es' => 'Español',
                'de' => 'Deutch',
                'fr' => 'Français',
                'nl' => 'Nederlands',
                'it' => 'Italiano',
                'vi' => 'Tiếng Việt',
                'ru' => 'русский',
                'tr' => 'Türkçe',
                'ar' => 'عربي'
            );

            $flag = array(
                "en"=>"flag-icon-us",
                "bn"=>"flag-icon-bd",
                "el"=>"flag-icon-gr",
                "pt"=>"flag-icon-pt",
                "es"=>"flag-icon-es",
                "de"=>"flag-icon-de",
                "fr"=>"flag-icon-fr",
                "nl"=>"flag-icon-nl",
                "it"=>"flag-icon-it",
                "vi"=>"flag-icon-vn",
                "ru"=>"flag-icon-ru",
                "tr"=>"flag-icon-tr",
                'ar'=>"flag-icon-sa"
            );

            $company_full_name = "No Company Imported";
            $activeCompany = [];
            if (Auth::check()) {
                $companies = auth()->user()->companies()->with(['settings'])->get();
                $firstCompanies = $companies->first();

                if (!empty(auth()->user()->company_id))
                    session(['company_id' => auth()->user()->company_id]);
                elseif(!empty($firstCompanies))
                    session(['company_id' => $firstCompanies->id]);

                foreach ($companies as $company) {
                    $company->setSettings();
                    if ($company->id == session('company_id')) {
                        $activeCompany = $company;
                        $company_full_name = $activeCompany->company_name;
                    }
                    $companySwitchingInfo[$company->id] = $company->company_name;
                }
            }

            if (empty($companySwitchingInfo)) {
                $companySwitchingInfo["0"] = "No Company Imported";
            }

            $view->with('ApplicationSetting', $application)
                ->with('companySwitchingInfo', $companySwitchingInfo)
                ->with('getLang', $getLang)
                ->with('company_full_name', $company_full_name)
                ->with('flag', $flag)
                ->with('companySettings', $activeCompany);
        });

    }
}
