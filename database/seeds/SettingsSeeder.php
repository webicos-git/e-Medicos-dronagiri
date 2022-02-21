<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('settings')->insert([
            'option_name' => 'system_name',
            'option_value' => 'Doctorino Doctor Chamber',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'address',
            'option_value' => '150 Logts : Bloc 16 N° 02 OUED TARFA - Draria',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'phone',
            'option_value' => '+213 657 04 19 93',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'hospital_email',
            'option_value' => 'hospital.email@gmail.com',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'currency',
            'option_value' => '₹',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'vat',
            'option_value' => '19',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'language',
            'option_value' => 'en',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'appointment_interval',
            'option_value' => '30',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'saturday_from',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'saturday_to',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'sunday_from',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'sunday_to',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'monday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'monday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'tuesday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'tuesday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'wednesday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'wednesday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'thursday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'thursday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'friday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'friday_to',
            'option_value' => '17:00',
        ]);

        DB::table('users')->insert([
            'name' => 'doctorino',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('doctorino'),
            'role' => 'admin',
        ]);

        // Add Xrays
        DB::table('xrays')->insert([
            'name' => 'Nasal Bone Xray',
            'amount' => '350',
            'description' => 'Test Description',
        ]);
        DB::table('xrays')->insert([
            'name' => 'Chest PA View',
            'amount' => '500',
            'description' => 'Test Description',
        ]);

        // Add Sonography
        DB::table('sonographies')->insert([
            'name' => 'Whole Abdomen',
            'amount' => '720',
            'description' => 'Test Description',
        ]);
        DB::table('sonographies')->insert([
            'name' => 'USG Left Arm',
            'amount' => '450',
            'description' => 'Test Description',
        ]);

        // Add Blood Tests
        DB::table('blood_tests')->insert([
            'name' => 'Complete blood count',
            'amount' => '400',
            'description' => 'Test Description',
        ]);
        DB::table('blood_tests')->insert([
            'name' => 'C-reactive protein test',
            'amount' => '680',
            'description' => 'Test Description',
        ]);

    }
}
