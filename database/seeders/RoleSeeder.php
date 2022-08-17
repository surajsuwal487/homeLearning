<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\UserAndRoles\Entities\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Role::create(['name' => 'superadmin']);
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'user']);
        }
    }
}
