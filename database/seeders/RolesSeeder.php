<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin role
        Roles::create(['name' => 'admin']);

        // Create organizer role
        Roles::create(['name' => 'organizer']);

        // Create user role
        Roles::create(['name' => 'user']);
    }
}
