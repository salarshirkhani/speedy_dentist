<?php

namespace Database\Seeders;

use App\Models\DoctorDetail;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateInitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '01712340889',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $admin->companies()->attach(1);
        $adminRole = Role::where('name', 'Super Admin')->first();
        $admin->assignRole([$adminRole->id]);

        $doctor = User::create([
            'company_id' => 1,
            'name' => 'Mr Doctor',
            'email' => 'doctor@ambitiousit.com',
            'password' => bcrypt('12345678'),
            'phone' => '01921456789',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $doctor->companies()->attach(1);
        $doctorRole = Role::where('name', 'Doctor')->first();
        $doctor->assignRole([$doctorRole->id]);

        $patient = User::create([
            'company_id' => 1,
            'name' => 'Mr Patient',
            'email' => 'patient@ambitiousit.com',
            'password' => bcrypt('12345678'),
            'phone' => '01621789456',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $patient->companies()->attach(1);
        $patientRole = Role::where('name', 'Patient')->first();
        $patient->assignRole([$patientRole->id]);

        $accountant = User::create([
            'company_id' => 1,
            'name' => 'Mr Accountant',
            'email' => 'accountant@ambitiousit.com',
            'password' => bcrypt('12345678'),
            'phone' => '01621781556',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $accountant->companies()->attach(1);
        $accountantRole = Role::where('name', 'Accountant')->first();
        $accountant->assignRole([$accountantRole->id]);

        $laboratorist = User::create([
            'company_id' => 1,
            'name' => 'Mr Laboratorist',
            'email' => 'laboratorist@ambitiousit.com',
            'password' => bcrypt('12345678'),
            'phone' => '01621731556',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $laboratorist->companies()->attach(1);
        $laboratoristRole = Role::where('name', 'Laboratorist')->first();
        $laboratorist->assignRole([$laboratoristRole->id]);

        $receptionist = User::create([
            'company_id' => 1,
            'name' => 'Mr Receptionist',
            'email' => 'receptionist@ambitiousit.com',
            'password' => bcrypt('12345678'),
            'phone' => '01921472789',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $receptionist->companies()->attach(1);
        $receptionistRole = Role::where('name', 'Receptionist')->first();
        $receptionist->assignRole([$receptionistRole->id]);
    }
}
