<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\UserAndRoles\Entities\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role       = Role::where('name', 'superadmin')->first();
        $superadmin = User::create([
         'name'     => 'Super Admin',
         'slug'=>"super-admin",
         'email'    => 'surajsuwal@admin.com',
         'phone_no' =>9803829209,
         'password' => Hash::make('surajsuwal'),
         'status'   => "active",
        ]);
        $superadmin->roles()->attach($role);

        $role1       = Role::where('name', 'user')->first();
        $user = User::create([
         'name'     => 'Default Customer',
         'slug'=>"default-customer",
         'email'    => 'user@user.com',
         'phone_no' =>9800300000,
         'password' => Hash::make('password'),
         'status'   => "active",
        ]);
        $user->roles()->attach($role1);
    }
}
