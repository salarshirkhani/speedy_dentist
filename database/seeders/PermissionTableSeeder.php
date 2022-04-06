<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate([
            'name' => 'role-read',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-create',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-update',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-delete',
            'display_name' => 'Role',
        ]);

        Permission::firstOrCreate([
            'name' => 'user-read',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-create',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-update',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-delete',
            'display_name' => 'User',
        ]);

        Permission::firstOrCreate([
            'name' => 'smtp-read',
            'display_name' => 'SMTP',
        ]);
        Permission::firstOrCreate([
            'name' => 'smtp-create',
            'display_name' => 'SMTP',
        ]);
        Permission::firstOrCreate([
            'name' => 'smtp-update',
            'display_name' => 'SMTP',
        ]);
        Permission::firstOrCreate([
            'name' => 'smtp-delete',
            'display_name' => 'SMTP',
        ]);

        Permission::firstOrCreate([
            'name' => 'company-read',
            'display_name' => 'Company',
        ]);
        Permission::firstOrCreate([
            'name' => 'company-create',
            'display_name' => 'Company',
        ]);
        Permission::firstOrCreate([
            'name' => 'company-update',
            'display_name' => 'Company',
        ]);
        Permission::firstOrCreate([
            'name' => 'company-delete',
            'display_name' => 'Company',
        ]);

        Permission::firstOrCreate([
            'name' => 'currencies-read',
            'display_name' => 'Currencies',
        ]);
        Permission::firstOrCreate([
            'name' => 'currencies-create',
            'display_name' => 'Currencies',
        ]);
        Permission::firstOrCreate([
            'name' => 'currencies-update',
            'display_name' => 'Currencies',
        ]);
        Permission::firstOrCreate([
            'name' => 'currencies-delete',
            'display_name' => 'Currencies',
        ]);

        Permission::firstOrCreate([
            'name' => 'tax-rate-read',
            'display_name' => 'Tax Rate',
        ]);
        Permission::firstOrCreate([
            'name' => 'tax-rate-create',
            'display_name' => 'Tax Rate',
        ]);
        Permission::firstOrCreate([
            'name' => 'tax-rate-update',
            'display_name' => 'Tax Rate',
        ]);
        Permission::firstOrCreate([
            'name' => 'tax-rate-delete',
            'display_name' => 'Tax Rate',
        ]);

        Permission::firstOrCreate([
            'name' => 'profile-read',
            'display_name' => 'Profile',
        ]);
        Permission::firstOrCreate([
            'name' => 'profile-update',
            'display_name' => 'Profile',
        ]);

        Permission::firstOrCreate([
            'name' => 'hospital-department-read',
            'display_name' => 'Hospital Department'
        ]);
        Permission::firstOrCreate([
            'name' => 'hospital-department-create',
            'display_name' => 'Hospital Department'
        ]);
        Permission::firstOrCreate([
            'name' => 'hospital-department-update',
            'display_name' => 'Hospital Department'
        ]);
        Permission::firstOrCreate([
            'name' => 'hospital-department-delete',
            'display_name' => 'Hospital Department'
        ]);

        Permission::firstOrCreate([
            'name' => 'doctor-detail-read',
            'display_name' => 'Doctor Detail'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-detail-create',
            'display_name' => 'Doctor Detail'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-detail-update',
            'display_name' => 'Doctor Detail'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-detail-delete',
            'display_name' => 'Doctor Detail'
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-detail-read',
            'display_name' => 'Patient Detail',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-detail-create',
            'display_name' => 'Patient Detail',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-detail-update',
            'display_name' => 'Patient Detail',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-detail-delete',
            'display_name' => 'Patient Detail',
        ]);

        Permission::firstOrCreate([
            'name' => 'patient-case-studies-read',
            'display_name' => 'Patient Case Studies',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-case-studies-create',
            'display_name' => 'Patient Case Studies',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-case-studies-update',
            'display_name' => 'Patient Case Studies',
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-case-studies-delete',
            'display_name' => 'Patient Case Studies',
        ]);

        Permission::firstOrCreate([
            'name' => 'insurance-read',
            'display_name' => 'Insurance',
        ]);

        Permission::firstOrCreate([
            'name' => 'insurance-create',
            'display_name' => 'Insurance',
        ]);

        Permission::firstOrCreate([
            'name' => 'insurance-update',
            'display_name' => 'Insurance',
        ]);

        Permission::firstOrCreate([
            'name' => 'insurance-delete',
            'display_name' => 'Insurance',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-read',
            'display_name' => 'Lab Report',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-create',
            'display_name' => 'Lab Report',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-update',
            'display_name' => 'Lab Report',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-delete',
            'display_name' => 'Lab Report',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-template-read',
            'display_name' => 'Lab Report Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-template-create',
            'display_name' => 'Lab Report Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-template-update',
            'display_name' => 'Lab Report Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'lab-report-template-delete',
            'display_name' => 'Lab Report Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-template-read',
            'display_name' => 'SMS Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-template-create',
            'display_name' => 'SMS Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-template-update',
            'display_name' => 'SMS Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-template-delete',
            'display_name' => 'SMS Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'email-template-read',
            'display_name' => 'Email Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'email-template-create',
            'display_name' => 'Email Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'email-template-update',
            'display_name' => 'Email Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'email-template-delete',
            'display_name' => 'Email Template',
        ]);

        Permission::firstOrCreate([
            'name' => 'email-campaign-read',
            'display_name' => 'Email Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'email-campaign-create',
            'display_name' => 'Email Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'email-campaign-update',
            'display_name' => 'Email Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'email-campaign-delete',
            'display_name' => 'Email Campaign',
        ]);

        Permission::firstOrCreate([
            'name' => 'doctor-schedule-read',
            'display_name' => 'Doctor Schedule'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-schedule-create',
            'display_name' => 'Doctor Schedule'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-schedule-update',
            'display_name' => 'Doctor Schedule'
        ]);
        Permission::firstOrCreate([
            'name' => 'doctor-schedule-delete',
            'display_name' => 'Doctor Schedule'
        ]);

        Permission::firstOrCreate([
            'name' => 'patient-appointment-read',
            'display_name' => 'Patient Appointment'
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-appointment-create',
            'display_name' => 'Patient Appointment'
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-appointment-update',
            'display_name' => 'Patient Appointment'
        ]);
        Permission::firstOrCreate([
            'name' => 'patient-appointment-delete',
            'display_name' => 'Patient Appointment'
        ]);

        Permission::firstOrCreate([
            'name' => 'prescription-read',
            'display_name' => 'Prescription',
        ]);
        Permission::firstOrCreate([
            'name' => 'prescription-create',
            'display_name' => 'Prescription',
        ]);
        Permission::firstOrCreate([
            'name' => 'prescription-update',
            'display_name' => 'Prescription',
        ]);
        Permission::firstOrCreate([
            'name' => 'prescription-delete',
            'display_name' => 'Prescription',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-api-read',
            'display_name' => 'SMS Api',
        ]);
        Permission::firstOrCreate([
            'name' => 'sms-api-update',
            'display_name' => 'SMS Api',
        ]);

        Permission::firstOrCreate([
            'name' => 'sms-campaign-read',
            'display_name' => 'SMS Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'sms-campaign-create',
            'display_name' => 'SMS Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'sms-campaign-update',
            'display_name' => 'SMS Campaign',
        ]);
        Permission::firstOrCreate([
            'name' => 'sms-campaign-delete',
            'display_name' => 'SMS Campaign',
        ]);

        Permission::firstOrCreate([
            'name' => 'account-header-read',
            'display_name' => 'Account Header',
        ]);

        Permission::firstOrCreate([
            'name' => 'account-header-create',
            'display_name' => 'Account Header',
        ]);

        Permission::firstOrCreate([
            'name' => 'account-header-update',
            'display_name' => 'Account Header',
        ]);

        Permission::firstOrCreate([
            'name' => 'account-header-delete',
            'display_name' => 'Account Header',
        ]);

        Permission::firstOrCreate([
            'name' => 'invoice-read',
            'display_name' => 'Invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'invoice-create',
            'display_name' => 'Invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'invoice-update',
            'display_name' => 'Invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'invoice-delete',
            'display_name' => 'Invoice',
        ]);

        Permission::firstOrCreate([
            'name' => 'payment-read',
            'display_name' => 'Payment',
        ]);

        Permission::firstOrCreate([
            'name' => 'payment-create',
            'display_name' => 'Payment',
        ]);

        Permission::firstOrCreate([
            'name' => 'payment-update',
            'display_name' => 'Payment',
        ]);

        Permission::firstOrCreate([
            'name' => 'payment-delete',
            'display_name' => 'Payment',
        ]);

        Permission::firstOrCreate([
            'name' => 'financial-report-read',
            'display_name' => 'Financial Report',
        ]);

        Permission::firstOrCreate([
            'name' => 'front-end-read',
            'display_name' => 'Front End',
        ]);

        Permission::firstOrCreate([
            'name' => 'front-end-create',
            'display_name' => 'Front End',
        ]);

        Permission::firstOrCreate([
            'name' => 'front-end-update',
            'display_name' => 'Front End',
        ]);

        Permission::firstOrCreate([
            'name' => 'front-end-delete',
            'display_name' => 'Front End',
        ]);

        Permission::firstOrCreate([
            'name' => 'contact-us-read',
            'display_name' => 'Contact Us',
        ]);

        Permission::firstOrCreate([
            'name' => 'contact-us-delete',
            'display_name' => 'Contact Us',
        ]);
    }
}
