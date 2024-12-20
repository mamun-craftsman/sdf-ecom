<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Agent', 'guard_name' => 'agent']);
        Role::create(['name' => 'Farmer', 'guard_name' => 'farmer']);
        Role::create(['name' => 'Business', 'guard_name' => 'business']);
        Role::create(['name' => 'Customer', 'guard_name' => 'admin']);
    }
}

