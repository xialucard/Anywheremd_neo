<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        //\App\Models\Warehouse::factory(100)->create();
        /**
         * Seed Role
         */
        Role::create(['name' => 'Admin', 'internal' => 1]);
        Role::create(['name' => 'Clinic Admin', 'internal' => 0]);
        Role::create(['name' => 'Doctor', 'internal' => 0]);
        Role::create(['name' => 'Client', 'internal' => 0]);

        /**
         * Seed User
         */
        User::create([
            'f_name' => 'Paul Allan',
            'm_name' => 'Palatulon',
            'l_name' => 'Zabala',
            'name' => 'Paul Allan Palatulon Zabala',
            'gender' => 'Male',
            'user_type' => 'Internal',
            'email' => 'ppzabala@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('chiescake')
        ])->assignRole('Admin');

        
    }
}
