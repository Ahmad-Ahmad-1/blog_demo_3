<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'admin@example.com',
        ]);
        $role1 = Role::where('name', 'Admin')->where('guard_name', 'sanctum')->first();
        $user1->assignRole($role1);

        $user2 = User::factory()->create([
            'name' => 'Super Admin 1',
            'email' => 'superadmin@example.com',
        ]);
        $role2 = Role::where('name', 'Super Admin')->where('guard_name', 'sanctum')->first();
        $user2->assignRole($role2);
    }
}
