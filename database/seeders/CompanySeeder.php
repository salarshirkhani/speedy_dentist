<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\SmsApi;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::create([
            'domain' => 'identsoft.ambitiousit.net',
            'enabled' => 1
        ]);

        $currencyRows = [
            [
                'company_id' => $company->id,
                'name' => 'US Dollar',
                'code' => 'USD',
                'rate' => '1.00',
                'enabled' => '1',
                'precision' => config('money.USD.precision'),
                'symbol' => config('money.USD.symbol'),
                'symbol_first' => config('money.USD.symbol_first'),
                'decimal_mark' => config('money.USD.decimal_mark'),
                'thousands_separator' => config('money.USD.thousands_separator'),
            ],
            [
                'company_id' => $company->id,
                'name' => 'Euro',
                'code' => 'EUR',
                'rate' => '1.25',
                'precision' => config('money.EUR.precision'),
                'symbol' => config('money.EUR.symbol'),
                'symbol_first' => config('money.EUR.symbol_first'),
                'decimal_mark' => config('money.EUR.decimal_mark'),
                'thousands_separator' => config('money.EUR.thousands_separator'),
            ],
            [
                'company_id' => $company->id,
                'name' => 'British Pound',
                'code' => 'GBP',
                'rate' => '1.60',
                'precision' => config('money.GBP.precision'),
                'symbol' => config('money.GBP.symbol'),
                'symbol_first' => config('money.GBP.symbol_first'),
                'decimal_mark' => config('money.GBP.decimal_mark'),
                'thousands_separator' => config('money.GBP.thousands_separator'),
            ],
            [
                'company_id' => $company->id,
                'name' => 'Turkish Lira',
                'code' => 'TRY',
                'rate' => '0.80',
                'precision' => config('money.TRY.precision'),
                'symbol' => config('money.TRY.symbol'),
                'symbol_first' => config('money.TRY.symbol_first'),
                'decimal_mark' => config('money.TRY.decimal_mark'),
                'thousands_separator' => config('money.TRY.thousands_separator'),
            ]
        ];
        foreach ($currencyRows as $row) {
            Currency::create($row);
        }
        $smsApiRows = [
            [
                'company_id' => $company->id,
                'gateway' => 'twilio',
                'auth_id' => '',
                'auth_token' => '',
                'api_id' => '',
                'sender_number' => '',
                'status' => '0'
            ],
            [
                'company_id' => $company->id,
                'gateway' => 'nexmo',
                'auth_id' => '',
                'auth_token' => '',
                'api_id' => '',
                'sender_number' => '',
                'status' => '0'
            ],
            [
                'company_id' => $company->id,
                'gateway' => 'plivo',
                'auth_id' => '',
                'auth_token' => '',
                'api_id' => '',
                'sender_number' => '',
                'status' => '0'
            ],
            [
                'company_id' => $company->id,
                'gateway' => 'clickatell',
                'auth_id' => '',
                'auth_token' => '',
                'api_id' => '',
                'sender_number' => '',
                'status' => '0'
            ],
        ];
        foreach ($smsApiRows as $row) {
            SmsApi::create($row);
        }
        $rows = [
            [
                'company_id' => $company->id,
                'key' => 'general.company_name',
                'value' => 'ambitiousit',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.company_email',
                'value' => 'bd.ambitiousit@gmail.com',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.default_locale',
                'value' => 'en-GB',
            ],

            [
                'company_id' => $company->id,
                'key' => 'general.financial_start',
                'value' => now()->format('d-m'),
            ],

            [
                'company_id' => $company->id,
                'key' => 'general.timezone',
                'value' => 'Europe/London',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.date_format',
                'value' => 'd M Y',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.date_separator',
                'value' => 'space',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.percent_position',
                'value' => 'after',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.default_payment_method',
                'value' => 'offlinepayment.cash.1',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.email_protocol',
                'value' => 'mail',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.email_sendmail_path',
                'value' => '/usr/sbin/sendmail -bs',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.send_item_reminder',
                'value' => '0',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.schedule_time',
                'value' => '09:00',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.admin_theme',
                'value' => 'skin-green-light',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.list_limit',
                'value' => '25',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.use_gravatar',
                'value' => '0',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.session_handler',
                'value' => 'file',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.session_lifetime',
                'value' => '30',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.file_size',
                'value' => '2',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.file_types',
                'value' => 'pdf,jpeg,jpg,png',
            ],
            [
                'company_id' => $company->id,
                'key' => 'general.wizard',
                'value' => '0',
            ],
        ];
        foreach ($rows as $row) {
            Setting::create($row);
        }

        $addressRow = [
            [
                'company_id' => $company->id,
                'key' => 'general.company_address',
                'value' => 'Natore, Bangladesh<br>',
            ],
        ];

        foreach ($addressRow as $row) {
            Setting::create($row);
        }

        $photoRows = [
            'company_id' => $company->id,
            'key' => 'general.company_logo',
            'value' => ''
        ];
        Setting::create($photoRows);
    }
}
