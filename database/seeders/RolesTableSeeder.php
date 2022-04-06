<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'is_default' => '1',
            'role_for' => '0',
        ]);
        $permissions = Permission::select('id')
            ->where('name', 'not like', 'role-%')
            ->get()->pluck('id');
        $role->syncPermissions($permissions);

        $doctor = Role::create([
            'name' => 'Doctor',
            'guard_name' => 'web',
            'role_for' => '1',
            'is_default' => '1',
        ]);
        $doctorPermissions = Permission::select('id')
            ->where('name', 'doctor-detail-read')
            ->orWhere('name', 'like', 'patient-detail-%')
            ->orWhere('name', 'like', 'patient-case-studies-%')
            ->orWhere('name', 'lab-report-read')
            ->orWhere('name', 'doctor-schedule-read')
            ->orWhere('name', 'patient-appointment-read')
            ->orWhere('name', 'like', 'prescription-%')
            ->get()->pluck('id');
        $doctor->syncPermissions($doctorPermissions);

        $patient = Role::create([
            'name' => 'Patient',
            'guard_name' => 'web',
            'role_for' => '1',
            'is_default' => '1',
        ]);
        $patientPermissions = Permission::select('id')
            ->where('name', 'doctor-detail-read')
            ->orWhere('name', 'patient-detail-read')
            ->orWhere('name', 'patient-case-studies-read')
            ->orWhere('name', 'insurance-read')
            ->orWhere('name', 'lab-report-read')
            ->orWhere('name', 'doctor-schedule-read')
            ->orWhere('name', 'patient-appointment-read')
            ->orWhere('name', 'prescription-read')
            ->orWhere('name', 'invoice-read')
            ->get()->pluck('id');
        $patient->syncPermissions($patientPermissions);

        $accountant = Role::create([
            'name' => 'Accountant',
            'guard_name' => 'web',
            'role_for' => '1',
            'is_default' => '1',
        ]);
        $accountantPermissions = Permission::select('id')
            ->where('name', 'like', 'account-header-%')
            ->orWhere('name', 'like', 'invoice-%')
            ->orWhere('name', 'like', 'payment-%')
            ->orWhere('name', 'financial-report-read')
            ->get()->pluck('id');
        $accountant->syncPermissions($accountantPermissions);

        $laboratorist = Role::create([
            'name' => 'Laboratorist',
            'guard_name' => 'web',
            'role_for' => '1',
            'is_default' => '1',
        ]);
        $laboratoristPermissions = Permission::select('id')
            ->where('name', 'doctor-detail-read')
            ->orWhere('name', 'like', 'patient-detail-read')
            ->orWhere('name', 'like', 'patient-case-studies-read')
            ->orWhere('name', 'like', 'lab-report-%')
            ->orWhere('name', 'like', 'lab-report-template-%')
            ->get()->pluck('id');
        $laboratorist->syncPermissions($laboratoristPermissions);

        $receptionist = Role::create([
            'name' => 'Receptionist',
            'guard_name' => 'web',
            'role_for' => '1',
            'is_default' => '1',
        ]);
        $receptionistPermissions = Permission::select('id')
            ->where('name', 'doctor-detail-read')
            ->orWhere('name', 'like', 'patient-detail-%')
            ->orWhere('name', 'like', 'patient-case-studies-%')
            ->orWhere('name', 'lab-report-read')
            ->orWhere('name', 'like', 'doctor-schedule-%')
            ->orWhere('name', 'like', 'patient-appointment-%')
            ->orWhere('name', 'like', 'prescription-read')
            ->get()->pluck('id');
        $receptionist->syncPermissions($receptionistPermissions);
    }
}
