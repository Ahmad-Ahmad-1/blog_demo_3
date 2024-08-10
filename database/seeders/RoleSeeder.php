<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'sanctum']);
        $role->givePermissionTo(Permission::pluck('name')->all());

        $role = Role::create(['name' => 'Admin', 'guard_name' => 'sanctum']);
        $role->givePermissionTo('Create Post');
        $role->givePermissionTo('Edit Post');
        $role->givePermissionTo('Delete Post');
    }
}
