<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);

        // RoleSeeder
        // $role1 = Role::create(['name' => 'Super Admin', 'guard_name' => 'sanctum']);
        // $role->givePermissionTo(Permission::pluck('name')->all());

        // $role = Role::create(['name' => 'Admin', 'guard_name' => 'sanctum']);
        // $role->givePermissionTo('Create Post');
        // $role->givePermissionTo('Edit Post');
        // $role->givePermissionTo('Delete Post');

        // // UserSeeder
        // $user1 = User::factory()->create([
        //     'name' => 'Admin 1',
        //     'email' => 'admin@example.com',
        // ]);
        // $user1->assignRole('Admin');

        // $user2 = User::factory()->create([
        //     'name' => 'Super Admin 1',
        //     'email' => 'superadmin@example.com',
        // ]);
        // $user2->assignRole('Super Admin');
    }
}
