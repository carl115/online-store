<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'User']);

        Permission::create(['name' => 'dashboard.products'])->assignRole($role1);
        Permission::create(['name' => 'dashboard.purchases'])->assignRole($role1);
        Permission::create(['name' => 'dashboard.categories'])->assignRole($role1);
        Permission::create(['name' => 'dashboard.users'])->assignRole($role1);
    }
}
