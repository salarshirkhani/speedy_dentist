<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApplicationSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ApplicationSetting::create([
            'item_name' => 'iDentSoft',
            'item_short_name' => 'iDentSoft',
            'item_version' => '1.1.0',
            'company_name' => 'ambitiousit',
            'company_email' => 'bd.ambitiousit@gmail.com',
            'company_address' => 'Natore, Bangladesh',
            'developed_by' => 'Ambitiousit',
            'developed_by_href' => 'http://ambitiousit.net/',
            'developed_by_title' => 'Your hope our goal',
            'developed_by_prefix' => 'Developed by',
            'support_email' => 'bd.ambitiousit@gmail.com',
            'language' => 'en',
            'is_demo' => '0',
            'time_zone' => 'Asia/Dhaka',
        ]);
    }
}
